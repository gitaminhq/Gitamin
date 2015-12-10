<?php

/*
 * This file is part of Gitamin.
 * 
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Presenters;

use Gitamin\Facades\Setting;
use Gitamin\Models\Comment;
use Gitamin\Models\Issue;
use Gitamin\Models\Moment;
use Gitamin\Presenters\Traits\TimestampsTrait;
use GrahamCampbell\Markdown\Facades\Markdown;
use Jenssegers\Date\Date;

class MomentPresenter extends AbstractPresenter
{
    use TimestampsTrait;

    /**
     * Renders the message from Markdown into HTML.
     *
     * @return string
     */
    public function formattedData()
    {
        return Markdown::convertToHtml($this->wrappedObject->data);
    }

    public function formattedTarget()
    {
        if ($this->wrappedObject->target instanceof Comment) {
            return Markdown::convertToHtml($this->wrappedObject->target->message);
        } elseif ($this->wrappedObject->target instanceof Issue) {
            return Markdown::convertToHtml($this->wrappedObject->target->description);
        }
    }

    /** 
     * Get the moment action summary.
     *
     * @return string
     */
    protected function actionName()
    {
        switch ($this->wrappedObject->action) {
            case Moment::CREATED:
                return 'Created';
            case Moment::CLOSED:
                return 'Closed';
            case Moment::COMMENTED:
                return 'commented on';
            default:
                return 'Unknow';
        }
    }

    public function icon()
    {
        if ($this->wrappedObject->target instanceof Comment) {
            return 'fa fa-comments-o';
        } elseif ($this->wrappedObject->target instanceof Issue) {
            return 'fa fa-exclamation-circle';
        } else {
            return 'fa fa-code-fork';
        }
    }

    /**
     * Present formatted date time.
     *
     * @return string
     */
    public function created_at_iso()
    {
        return $this->wrappedObject->created_at->setTimezone($this->setting->get('app_timezone'))->toISO8601String();
    }

    /**
     * Convert presented moment to an array.
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'summary'        => $this->summary(),
            'created_at_iso' => $this->created_at_iso(),
        ];
    }
}