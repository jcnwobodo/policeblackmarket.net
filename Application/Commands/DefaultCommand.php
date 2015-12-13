<?php
namespace Application\Commands;

use System\Request\RequestContext;
use Application\Models\Report;
use Application\Models\Post;

class DefaultCommand extends Command
{
    protected function doExecute(RequestContext $requestContext)
    {
        $data = array();
        $approved_reports = Report::getMapper('Report')->findByStatus(Report::STATUS_APPROVED, 4);
        $published_news = Post::getMapper('Post')->findTypeByStatus(Post::TYPE_NEWS, Post::STATUS_PUBLISHED, 3);
        $about = Post::getMapper('Post')->findByPamalink('about');
        $how_it_works = Post::getMapper('Post')->findByPamalink('how-it-works');

        $data['reports'] = $approved_reports;
        $data['news'] = $published_news;
        $data['about'] = $about;
        $data['how-it-works'] = $how_it_works;
        $requestContext->setView('index.php');
        $requestContext->setResponseData($data);
    }
}