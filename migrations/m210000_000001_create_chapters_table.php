use yii\db\Migration;

/**
 * Handles the creation of table `{{%chapters}}`.
 */
class m210000_000001_create_chapters_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%chapters}}', [
            'id' => $this->primaryKey(),
            'course_id' => $this->integer()->notNull(),
            'title' => $this->string()->notNull()->unique(),
            'content' => $this->text()->notNull(),
            'create_at' => $this->datetime()->notNull(),
            'update_at' => $this->datetime()->notNull(),
            'extra_field_1' => $this->string()->notNull()->unique(),
            'extra_field_2' => $this->string()->notNull()->unique(),
            'extra_field_3' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey(
            'fk-chapters-course_id',
            'chapters',
            'course_id',
            'courses',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-chapters-course_id',
            'chapters'
        );

        $this->dropTable('{{%chapters}}');
    }
}
