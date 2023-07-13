use yii\db\Migration;

/**
 * Handles the creation of table `{{%courses}}`.
 */
class m210000_000000_create_courses_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%courses}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->unique(),
            'description' => $this->text()->notNull(),
            'create_at' => $this->datetime()->notNull(),
            'update_at' => $this->datetime()->notNull(),
            'extra_field_1' => $this->string()->notNull()->unique(),
            'extra_field_2' => $this->string()->notNull()->unique(),
            'extra_field_3' => $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%courses}}');
    }
}
