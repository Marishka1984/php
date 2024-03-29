<?php

namespace MyProject\Controllers;

use MyProject\Models\Articles\Article;
use MyProject\Models\Users\User;
use MyProject\View\View;

class ArticlesController
{
    /** @var View */
    private $view;

    public function __construct()
    {
        $this->view = new View(__DIR__ . '/../../../templates');
    }

    public function view(int $articleId): void
    {
        $article = Article::getById($articleId);

        if ($article === null) {
            throw new NotFoundException();
        }

        $this->view->renderHtml('articles/view.php', [
            'article' => $article
        ]);
    }

    public function edit(int $articleId): void
    {
        $article = Article::getById($articleId);
    
        if ($article === null) {
            throw new NotFoundException();
        }
    
        $article->setName(' Это новое название статьи');
        $article->setText('Новый текст статьи');
    
        $article->save();
    }
    
    public function add(): void
    {   
        $author = User::getById(1);
        
        $article = new Article();
        $article->setAuthor($author);
        $article->setName('Новое название статьи');
        $article->setText('Новый текст статьи');
    
        $article->save();
    
        var_dump($article);
    }
    
    public function remove(int $articleId): void
    {   
        $article = Article::getById($articleId); 
    
        if ($article){               
            $article->delete();
        } else {
            echo "Такой статьи нет!!!";
        }
    }
}