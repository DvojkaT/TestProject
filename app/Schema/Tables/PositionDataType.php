<?php

namespace App\Schema\Tables;

use App\Models\Position;
use Atwinta\Voyager\Domain\Enum\FieldType;
use Atwinta\Voyager\Schema\BaseDataType;

/**
 * Class UserDataType
 * @package Atwinta\Voyager\Schema
 */
class PositionDataType extends BaseDataType
{
    protected function model(): string
    {
        return Position::class;
    }

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
            //"controller" => "TCG\Voyager\Http\Controllers\VoyagerUserController",
            //"policy_name" => "TCG\Voyager\Policies\UserPolicy",
            "model_name" => $this->model(),
            "display_name_singular" => "Должность",
            "display_name_plural" => "Должности",
        ];
    }

    public function getDataRowsArray(): array
    {
        return [
            $this->table()->getKeyName() => [
                "type" => FieldType::NUMBER,
                "display_name" => "#"
            ],
            "name" => [
                "display_name" => "Название должности",
            ],
            "created_at" => false,
            "updated_at" => false,
        ];
    }
}
