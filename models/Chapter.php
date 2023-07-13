namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * Class Chapter
 * @package app\models
 *
 * @property int $id
 * @property int $course_id
 * @property string $title
 * @property string $content
 * @property string $create_at
 * @property string $update_at
 * @property string $extra_field_1
 * @property string $extra_field_2
 * @property int $extra_field_3
 *
 * @property Course $course
 */
class Chapter extends ActiveRecord
{
    const UNIQUE_ERROR_MESSAGE = 'This value is already in use. Please provide a unique value.';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'chapters';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'create_at',
                'updatedAtAttribute' => 'update_at',
                'value' => date('Y-m-d H:i:s'),
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'content', 'extra_field_1', 'extra_field_2', 'extra_field_3'], 'required'],
            [['title', 'extra_field_1', 'extra_field_2'], 'unique', 'message' => Yii::t('app', self::UNIQUE_ERROR_MESSAGE)],
            [['content'], 'string', 'max' => 255],
            [['extra_field_3'], 'integer', 'min' => 1],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'title' => Yii::t('app', 'Title'),
            'content' => Yii::t('app', 'Content'),
            'create_at' => Yii::t('app', 'Created At'),
            'update_at' => Yii::t('app', 'Updated At'),
            'extra_field_1' => Yii::t('app', 'Extra Field 1'),
            'extra_field_2' => Yii::t('app', 'Extra Field 2'),
            'extra_field_3' => Yii::t('app', 'Extra Field 3'),
        ];
    }

    /**
     * Gets the course this chapter belongs to
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCourse()
    {
        return $this->hasOne(Course::className(), ['id' => 'course_id']);
    }

    /**
     * After save method
     *
     * @param bool $insert
     * @param array $changedAttributes
     */
    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        $mailQueue = new MailQueue();
        $mailQueue->subject = Yii::t('app', 'Chapter Updated');
        $mailQueue->template = Yii::t('app', 'Chapter {title} has been updated.', ['title' => $this->title]);
        $mailQueue->status = MailQueue::STATUS_NEW;
        $mailQueue->course_id = $this->course_id;
        $mailQueue->save();
    }
}
