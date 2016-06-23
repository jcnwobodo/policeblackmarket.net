<?php
namespace Application\Controllers;

use System\Request\RequestContext;
use Application\Models\Report;
use Application\Models\Post;

class Default_Controller extends A_Controller
{
    protected function doExecute(RequestContext $requestContext)
    {
        $data = array();
        $approved_reports = Report::getMapper('Report')->findByStatus(Report::STATUS_APPROVED, 10);
        $published_news = Post::getMapper('Post')->findTypeByStatus(Post::TYPE_NEWS, Post::STATUS_PUBLISHED, 5);
        $about = Post::getMapper('Post')->findByGuid('about');
        $how_it_works = Post::getMapper('Post')->findByGuid('how-it-works');

        $data['reports'] = $approved_reports;
        $data['news'] = $published_news;
        $data['about'] = $about;
        $data['how-it-works'] = $how_it_works;
        $requestContext->setView('index.php');
        $requestContext->setResponseData($data);
    }
}