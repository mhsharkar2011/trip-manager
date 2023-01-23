<?php

namespace App\Devpanel\Models;

use App\Models\User;


class Comment extends baseModel
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'comments';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['commentable_type', 'commentable_id', 'comment', 'type', 'comment_by', 'project_id'];

    protected $guarded = [
        'id'
    ];

    const TYPE_DECISION = 'DECISION';
    const TYPE_NOTE = 'NOTE';
    const TYPE_WARNING = 'WARNING';
    const TYPE_POLICY = 'POLICY';
    const TYPE_COMMENT = 'COMMENT';
    const TYPE_PRIVATE = 'PRIVATE';

    /**
     * Comment types.
     * These all ar static so you may change it anytime
     * @var array
     */
    protected static $types = [
        [
            'name' => self::TYPE_DECISION,
            'label' => 'Decision',
        ],
        [
            'name' => self::TYPE_NOTE,
            'label' => 'Note',
        ],
        [
            'name' => self::TYPE_WARNING,
            'label' => 'Warning',
        ],
        [
            'name' => self::TYPE_POLICY,
            'label' => 'Policy',
        ],
        [
            'name' => self::TYPE_COMMENT,
            'label' => 'Comment',
        ],
        [
            'name' => self::TYPE_PRIVATE,
            'label' => 'Private',
        ],
    ];

    protected static function validation_rules() {
        return [];
    }

    protected static function validation_messages() {
        return [];
    }

    protected static function validation_rules_for_update() {
        return self::validation_rules();
    }

    protected static function validation_messages_for_update() {
        return self::validation_messages();
    }

//    public static function boot() // if want to set any default comment type
//    {
//        parent::boot();
//
//        self::creating(function($model){
//            if (!$model->type)
//                $model->type = self::TYPE_COMMENT;
//        });
//    }

    public function commentable()
    {
        return $this->morphTo();
    }

    public function commentBy()
    {
        return$this->belongsTo(User::class, 'comment_by');
    }

    public static function getCommentTypes()
    {
        return static::$types;
    }

//    public function project() // when project will crud project crud
//    {
//        return$this->belongsTo(Project::class, 'project_id');
//    }
}
