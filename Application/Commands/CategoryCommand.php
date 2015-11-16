<?php
/**
 * Phoenix Laboratories NG.
 * Author: J. C. Nwobodo (jc.nwobodo@gmail.com)
 * Project: thehouseoflaws.org
 * Date:    10/24/2015
 * Time:    11:54 AM
 */

namespace Application\Commands;

use Application\Models;
use System\Request\RequestContext;

class CategoryCommand extends Command
{
    private $category_mapper;
    private $posts_mapper;

    protected function doExecute(RequestContext $requestContext)
    {
        $this->category_mapper = Models\Category::getMapper("Category");
        $this->posts_mapper = Models\Post::getMapper("Post");

        $request_category = $this->category_mapper->findByPamalink($requestContext->getRequestUrlParam(1));
        if( ! is_null($request_category))
        {
            $possible_posts = $this->posts_mapper->findByCategory($request_category->getId());
            $requestContext->setResponseData($possible_posts);
            $possible_view = "category-{$request_category->getPamalink()}.php";

        }
        else
        {
            $all_categories = $this->category_mapper->findAll();
            $requestContext->setResponseData($all_categories);
            $possible_view = "list-categories.php";
        }

        if($requestContext->viewExists($possible_view))
        {
            $requestContext->setView($possible_view);
        }
        elseif($requestContext->viewExists('category.php'))
        {
            $requestContext->setView('category.php');
        }
        else
        {
            $requestContext->setView('index.php');
        }
    }
}