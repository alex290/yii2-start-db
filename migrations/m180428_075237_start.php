<?php

use yii\db\Migration;

/**
 * Class m180428_075237_start
 */
class m180428_075237_start extends Migration
{

    public function up()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'username' => $this->string(50)->notNull(),
            'first_name' => $this->string(50),
            'last_name' => $this->string(50),
            'mail' => $this->string(50),
            'password' => $this->string(255),
            'authKey' => $this->string(255),
            'accessToken' => $this->string(255),
        ]);
        
        $this->createTable('category', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'parent_id' => $this->integer(11)->notNull(),
            'weight' => $this->integer(11)->defaultValue(0),
            'description' => $this->text(),
            'alias' => $this->string(255)->notNull(),
            'meta_description' => $this->string(255),
        ]);
        
        $this->createTable('article', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'category_id' => $this->integer(11)->notNull(),
            'date_create' => $this->integer(50)->notNull(),
            'user_id' => $this->integer(11)->notNull(),
            'body' => $this->text(),
            'frontpage' => $this->integer(1)->defaultValue(0),
            'alias' => $this->string(255)->notNull(),
            'meta_description' => $this->string(255),
            'count' => $this->integer(100)->defaultValue(0),
        ]);
        
        // creates index for column `user_id`
        $this->createIndex(
            'idx-article-user_id',
            'article',
            'user_id'
        );
        
        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-article-user_id',
            'article',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );
        
        // creates index for column `category_id`
        $this->createIndex(
            'idx-article-category_id',
            'article',
            'category_id'
        );
        
        // add foreign key for table `category`
        $this->addForeignKey(
            'fk-article-category_id',
            'article',
            'category_id',
            'category',
            'id',
            'CASCADE'
        );

    }

    public function down()
    {
        echo "m180428_075237_start cannot be reverted.\n";
        
        $this->dropTable('user');
        $this->dropTable('category');
        
        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-article-user_id',
            'article'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-article-user_id',
            'article'
        );
        
        // drops foreign key for table `category`
        $this->dropForeignKey(
            'fk-article-category_id',
            'article'
        );

        // drops index for column `category_id`
        $this->dropIndex(
            'idx-article-category_id',
            'article'
        );
        
        $this->dropTable('article');
    }

}
