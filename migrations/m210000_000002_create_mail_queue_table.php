use yii\db\Migration;

/**
 * Handles the creation of table `{{%mail_queue}}`.
 */
class m210000_000002_create_mail_queue_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("
            CREATE TABLE `mail_queue` (
                `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
                `course_id` INT(11) UNSIGNED NOT NULL,
                `subject` VARCHAR(255) NOT NULL,
                `template` TEXT NOT NULL,
                `status` ENUM('new', 'sent', 'error') NOT NULL DEFAULT 'new',
                PRIMARY KEY (`id`),
                FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
        ");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->execute("
            DROP TABLE IF EXISTS `mail_queue`;
        ");
    }
}
