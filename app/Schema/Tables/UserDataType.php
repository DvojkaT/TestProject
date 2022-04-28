<?php

namespace App\Schema\Tables;

use Atwinta\Voyager\Domain\Enum\FieldType;
use Atwinta\Voyager\Schema\BaseDataType;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

/**
 * Class UserDataType
 * @package Atwinta\Voyager\Schema
 */
class UserDataType extends BaseDataType
{
    /**
     * @inheritdoc
     */
    protected function model(): string
    {
        return User::class;
    }

    /**
     * @inheritdoc
     */
    public function getDataTypeArray(): array
    {
        /**
         * @property string custom_menu_title - not required value
         * @property string custom_menu_icon - not required value
         * @property string custom_menu_url - not required value
         */
        return [
            "slug" => $this->table()->getTable(),
            "roles" => "*",
            "controller" => "TCG\Voyager\Http\Controllers\VoyagerUserController",
            "policy_name" => "TCG\Voyager\Policies\UserPolicy",
            "model_name" => $this->model(),
            "display_name_singular" => "Пользователь",
            "display_name_plural" => "Пользователи",
        ];
    }

    /**
     * @inheritdoc
     */
    public function getDataRowsArray(): array
    {
        return [
            $this->table()->getKeyName() => [
                "type" => FieldType::NUMBER,
                "display_name" => "#"
            ],
            "name" => [
                "display_name" => "Имя",
            ],
            "user_belongsto_department_relationship" => [
                "type" => FieldType::RELATIONSHIP,
                "display_name" => "Отдел",
                "required" => false,
                "delete" => false,
                "browse" => true,
                "details" => [
                    "model" => "App\Models\Department",
                    "table" => "departments",
                    "type" => "belongsTo",
                    "column" => "department_id",
                    "key" => "id",
                    "label" => "name",
                    "pivot_table" => "departments",
                    "pivot" => 0
                ]
            ],
            "department_id" => [
                "display_name" => "Отдел"
            ],
            "user_belongsto_position_relationship" => [
                "type" => FieldType::RELATIONSHIP,
                "display_name" => "Должность",
                "required" => false,
                "delete" => false,
                "browse" => true,
                "details" => [
                    "model" => "App\Models\Position",
                    "table" => "positions",
                    "type" => "belongsTo",
                    "column" => "position_id",
                    "key" => "id",
                    "label" => "name",
                    "pivot_table" => "positions",
                    "pivot" => 0
                ]
            ],
            "position_id" => [
                "display_name" => "Должность"
            ],
            "type" => [
                "display_name" => "Тип"
            ],
            "about" => [
                "display_name" => "Обо мне",
                "required" => false,
                "edit" => true,
            ],
            "birthday" => [
                "display_name" => "Дата рождения",
                "browse" => false,
            ],
            "phone" => [
                "display_name" => "Номер телефона",
            ],
            "github" => [
                "display_name" => "GitHub"
            ],
            "city" => [
                "display_name" => "Город"
            ],
            "email" => [
                "display_name" => "Почта",
            ],
            "password" => [
                "type" => FieldType::PASSWORD,
                "display_name" => "Пароль",
                "required" => true,
                "browse" => false,
                "read" => false,
                "edit" => true,
                "add" => true
            ],
            "remember_token" => [
                "display_name" => "Почта",
                "required" => false,
                "browse" => false,
                "read" => false,
                "edit" => false,
                "add" => false
            ],
            "is_finished" => [
                "display_name" => "Закончил работу",
                "required" => false,
            ],
            "adopted_at" => [
                "display_name" => "Дата принятия",
                "required" => false,
                "browse" => false,
            ],
            "email_verified_at" => [
                "display_name" => "Дата подтверждения почты",
                "required" => false,
                "browse" => false,
            ],
            "image" => [
                "display_name" => "Фото",
                "required" => false,
                "browse" => false,
            ],
            "avatar" => [
                "type" => FieldType::IMAGE,
                "display_name" => "Аватар",
                "required" => false,
                "browse" => false,
            ],
            "user_belongsto_role_relationship" => [
                "type" => FieldType::RELATIONSHIP,
                "display_name" => "Роль",
                "required" => false,
                "delete" => false,
                "browse" => true,
                "details" => [
                    "model" => "TCG\\Voyager\\Models\\Role",
                    "table" => "roles",
                    "type" => "belongsTo",
                    "column" => "role_id",
                    "key" => "id",
                    "label" => "display_name",
                    "pivot_table" => "roles",
                    "pivot" => 0
                ]
            ],
            "role_id" => [
                "display_name" => "Роль"
            ],
            "user_belongstomany_role_relationship" => [
                "type" => FieldType::RELATIONSHIP,
                "display_name" => "Дополнительные роли",
                "required" => false,
                "delete" => false,
                "browse" => false,
                "details" => [
                    "model" => "TCG\\Voyager\\Models\\Role",
                    "table" => "roles",
                    "type" => "belongsToMany",
                    "column" => "id",
                    "key" => "id",
                    "label" => "display_name",
                    "pivot_table" => "user_roles",
                    "pivot" => "1",
                    "taggable" => "0"
                ]
            ],
            "settings" => [
                "type" => FieldType::HIDDEN,
                "display_name" => "Настройки",
                "browse" => false,
                "read" => false,
                "edit" => false,
                "add" => false,
                "delete" => false
            ],
            Model::CREATED_AT => [
                "display_name" => "Дата создания",
                "browse" => false,
                "read" => true,
                "edit" => false,
                "add" => false
            ],
        ];
    }
}
