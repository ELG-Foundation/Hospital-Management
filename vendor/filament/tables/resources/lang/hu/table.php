<?php

return [

    'column_toggle' => [

        'heading' => 'Oszlopok',

    ],

    'columns' => [

        'text' => [
            'more_list_items' => 'és további :count',
        ],

    ],

    'fields' => [

        'bulk_select_page' => [
            'label' => 'Az összes elem kijelölése vagy a kijelölés megszüntetése csoportos műveletekhez.',
        ],

        'bulk_select_record' => [
            'label' => ':key elem kijelölése vagy a kijelölés megszüntetése csoportos műveletekhez.',
        ],

        'search' => [
            'label' => 'Keresés',
            'placeholder' => 'Keresés',
            'indicator' => 'Keress',
        ],

    ],

    'summary' => [

        'heading' => 'Összesítés',

        'subheadings' => [
            'all' => 'Összes :label',
            'group' => ':group összesítése',
            'page' => 'Ezen az oldalon',
        ],

        'summarizers' => [

            'average' => [
                'label' => 'Átlag',
            ],

            'count' => [
                'label' => 'Darab',
            ],

            'sum' => [
                'label' => 'Összeg',
            ],

        ],

    ],

    'actions' => [

        'disable_reordering' => [
            'label' => 'Átrendezés befejezése',
        ],

        'enable_reordering' => [
            'label' => 'Átrendezés',
        ],

        'filter' => [
            'label' => 'Szűrés',
        ],

        'group' => [
            'label' => 'Csoportosítás',
        ],

        'open_bulk_actions' => [
            'label' => 'Csoportos műveletek',
        ],

        'toggle_columns' => [
            'label' => 'Oszlopok láthatósága',
        ],

    ],

    'empty' => [

        'heading' => 'Nincs megjeleníthető elem',

        'description' => 'Hozz létre egy újat a kezdéshez.',

    ],

    'filters' => [

        'actions' => [

            'remove' => [
                'label' => 'Szűrő megszűntetése',
            ],

            'remove_all' => [
                'label' => 'Az összes szűrő megszűntetése',
                'tooltip' => 'Az összes szűrő megszűntetése',
            ],

            'reset' => [
                'label' => 'Visszaállítása',
            ],

        ],

        'heading' => 'Szűrők',

        'indicator' => 'Aktív szűrők',

        'multi_select' => [
            'placeholder' => 'Mind',
        ],

        'select' => [
            'placeholder' => 'Mind',
        ],

        'trashed' => [

            'label' => 'Törölt elemek',

            'only_trashed' => 'Csak a törölt elemek',

            'with_trashed' => 'Törölt elemekkel együtt',

            'without_trashed' => 'Törölt elemek nélkül',

        ],

    ],

    'grouping' => [

        'fields' => [

            'group' => [
                'label' => 'Csoportosítás',
                'placeholder' => 'Csoportosítás',
            ],

            'direction' => [

                'label' => 'Csoportosítás iránya',

                'options' => [
                    'asc' => 'Növekvő',
                    'desc' => 'Csökkenő',
                ],

            ],

        ],

    ],

    'reorder_indicator' => 'Kattints az elemekre és mozgasd őket az átrendezéshez.',

    'selection_indicator' => [

        'selected_count' => '1 elem kiválasztva|:count elem kiválasztva',

        'actions' => [

            'select_all' => [
                'label' => 'Mind a(z) :count elem kijelölése',
            ],

            'deselect_all' => [
                'label' => 'Kijelölés megszüntetése',
            ],

        ],

    ],

    'sorting' => [

        'fields' => [

            'column' => [
                'label' => 'Rendezés',
            ],

            'direction' => [

                'label' => 'Rendezési irány',

                'options' => [
                    'asc' => 'Növekvő',
                    'desc' => 'Csökkenő',
                ],

            ],

        ],

    ],

];
