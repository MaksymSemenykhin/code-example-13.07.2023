namespace app\models;

use yii\db\ActiveRecord;

/**
 * Class MailQueue
 * @package app\models
 *
 * @property int $id
 * @property int $course_id
 * @property string $subject
 * @property string $template
 * @property string $status
 */
class MailQueue extends ActiveRecord
{
    const STATUS_NEW = 'new';
    const STATUS_SENT = 'sent';
    const STATUS_ERROR = 'error';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mail_queue';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['subject', 'template', 'course_id'], 'required'],
            [['subject'], 'string', 'max' => 255],
            [['template'], 'string'],
            [['status'], 'in', 'range' => [self::STATUS_NEW, self::STATUS_SENT, self::STATUS_ERROR]],
            [['course_id'], 'integer'],
        ];
    }
}
