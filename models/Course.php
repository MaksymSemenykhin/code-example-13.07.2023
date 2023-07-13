namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * Class Course
 * @package app\models
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $create_at
 * @property string $update_at
 * @property string $extra_field_1
 * @property string $extra_field_2
 * @property int $extra_field_3
 *
 * @property Chapter[] $chapters
 */
class Course extends ActiveRecord
{
    const UNIQUE_ERROR_MESSAGE = 'This value is already in use. Please provide a unique value.';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'courses';
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
            [['name', 'description', 'extra_field_1', 'extra_field_2', 'extra_field_3'], 'required'],
            [['name', 'extra_field_1', 'extra_field_2'], 'unique', 'message' => Yii::t('app', self::UNIQUE_ERROR_MESSAGE)],
            [['description'], 'string', 'max' => 255],
            [['extra_field_3'], 'integer', 'min' => 1],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'create_at' => Yii::t('app', 'Created At'),
            'update_at' => Yii::t('app', 'Updated At'),
            'extra_field_1' => Yii::t('app', 'Extra Field 1'),
            'extra_field_2' => Yii::t('app', 'Extra Field 2'),
            'extra_field_3' => Yii::t('app', 'Extra Field 3'),
        ];
    }

    /**
     * Gets all chapters associated with this course
     *
     * @return \yii\db\ActiveQuery
     */
    public function getChapters()
    {
        return $this->hasMany(Chapter::className(), ['course_id' => 'id']);
    }
}
