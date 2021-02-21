<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;

class EntryForm extends Model {
    public $id;
    public $title;
    public $stores = [];
    public $week;
    public $link;
    public $images;

    public $storesArray = [
        'flt' => 'Flensburg',
        'sln' => 'Schleswig',
        'efz' => 'Eckernförde',
        'nft' => 'Niebüll',
        'syr' => 'Sylt',
        'inb' => 'Wyk auf Föhr',
        'hun' => 'Husum',
        'lza' => 'Rendsburg',
        'hoc' => 'Neumünster',
        'nra' => 'Itzehoe',
        'nrg' => 'Glücksstadt',
        'wiz' => 'Wilster',
        'oha' => 'Eutin',
        'stt' => 'Bad Oldesloe',
        'eln' => 'Elmshorn',
        'baz' => 'Barmstedt',
        'pit' => 'Pinneberg',
        'qbt' => 'Quickborn',
        'sft' => 'Schenefeld',
        'wet' => 'Wedel',
        'slb' => 'Lübz',
        'spa' => 'Parchim',
        'sgu' => 'Güstrow',
        'sga' => 'Gadebusch',
        'sha' => 'Hagenow',
        'slu' => 'Ludwigslust',
        'pri' => 'Perlenberg',
        'sst' => 'Sternberg',
        'ssn' => 'Schwerin',
        'nnn' => 'Rostock',
    ];

    /**
     * @return array validation rules
     */

    public function rules() {
        return [
            [['title', 'stores', 'week', 'link', 'images'], 'required'],
            [['title', 'link'], 'string', 'max' => 255],
        ];
    }

    /**
     * @return array input labels
     */

    public function attributeLabels() {
        return [
            'title' => 'Angebotstitel',
            'stores' => 'Filialen/Lokalbereiche',
            'week' => 'Veröffentlichung',
            'link' => 'URL der Detailansicht',
            'images' => 'Angebotsbilder',
        ];
    }  

    /**
     * Create array of upcoming weeks
     *
     * @param int $nextweek start date
     * @param int $number_of_weeks number of upcoming weeks
     * @param string $day_of_week day of the week to be displayed
     * @param string $label option value with placeholders %week% and %date%
     */

    public function getWeeks($nextweek, $number_of_weeks, $day_of_week, $label) {
        if($nextweek > time()) {
            // If upcoming week is in the future let user set it to a past date
            $nextweek = strtotime($day_of_week . ' - ' . ($number_of_weeks / 2) . ' weeks', $nextweek);
        }

        $weeks = [];

        // Create array of weeks
        for($i = 1; $i <= $number_of_weeks; $i++) {
            $nextweek = strtotime("next $day_of_week", $nextweek);
            $weeks[$nextweek] = str_replace(['%week%', '%date%'], [date("W", $nextweek), date('d.m.Y', $nextweek)], $label);
        }

        return $weeks;
    }

    /**
     * Get entry from database
     *
     * @param int $id of entry in database
     * @return Entry|false
     */

    public function getEntry(int $id) {
        return Entries::find($id)->where(['id' => $id])->one();
    }

    /**
     * Delete images of entry
     * 
     * @param object $entry from database
     */

    public function deleteImages(object $entry) {
        foreach(explode(',', $entry->images) as $item) {
            @unlink("./uploads/$item");
        }
    }
}