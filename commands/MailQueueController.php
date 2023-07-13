namespace app\commands;

use Yii;
use yii\console\Controller;
use app\models\Course;
use app\models\UserCourse;
use app\models\MailQueue;

/**
 * Class MailQueueController
 * @package app\commands
 *
 * MailQueueController(simplified demo version) sends email to users subscribed to a course when a chapter is updated.
 */
class MailQueueController extends Controller
{
    /**
     * This method sends emails to users.
     */
    public function actionSendMail()
    {
        $mailQueue = MailQueue::find()->where(['status' => MailQueue::STATUS_NEW])->one();

        if ($mailQueue) {
            $userCourses = UserCourse::find()->where(['course_id' => $mailQueue->course_id])->all();
            
            foreach ($userCourses as $userCourse) {
                try {
                    Yii::$app->mailer->compose()
                        ->setFrom(Yii::$app->params['adminEmail'])
                        ->setTo($userCourse->user->email)
                        ->setSubject($mailQueue->subject)
                        ->setHtmlBody($mailQueue->template)
                        ->send();
                    
                    $mailQueue->status = MailQueue::STATUS_SENT;
                    Yii::info('Mail sent to user: ' . $userCourse->user->email);
                } catch (\Throwable $e) {
                    $mailQueue->status = MailQueue::STATUS_ERROR;
                    Yii::error('Error sending mail to user: ' . $userCourse->user->email . ' ' . $e->getMessage());
                    break;
                }
                
            }
           $mailQueue->save();
        }
    }
}
