<?php
if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_artigo-para-manchete',
		'title' => 'Artigo para manchete',
		'fields' => array (
			array (
				'key' => 'field_578b96abe3cdf',
				'label' => 'Artigo Manchete',
				'name' => 'manchete_article',
				'type' => 'relationship',
				'instructions' => 'Escolha o artigo para a manchete',
				'required' => 1,
				'return_format' => 'id',
				'post_type' => array (
					0 => 'post',
					1 => 'service',
					2 => 'athlete',
				),
				'taxonomy' => array (
					0 => 'all',
				),
				'filters' => array (
					0 => 'search',
				),
				'result_elements' => array (
					0 => 'post_type',
					1 => 'post_title',
				),
				'max' => 1,
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'highlight',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_biografia',
		'title' => 'Biografia',
		'fields' => array (
			array (
				'key' => 'field_5787ee1436ff6',
				'label' => 'Nome',
				'name' => 'name',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_5787ef1836ffb',
				'label' => 'Equipa',
				'name' => 'team',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_5787ef2536ffc',
				'label' => 'Posição',
				'name' => 'position',
				'type' => 'select',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'null',
							'operator' => '==',
						),
					),
					'allorany' => 'all',
				),
				'choices' => array (
					'keeper' => 'Guarda-Redes',
					'center_back' => 'Defesa central',
					'left_back' => 'Defesa Esquerdo',
					'right_back' => 'Defesa Direito',
					'defending' => 'Médio Defensivo',
					'box_to_box' => 'Médio Centro',
					'left_wing' => 'Extremo Esquerdo',
					'right_wing' => 'Extremo Direito',
					'forward' => 'Avançado',
					'striker' => 'Ponta de Lança',
				),
				'default_value' => '',
				'allow_null' => 1,
				'multiple' => 0,
			),
			array (
				'key' => 'field_5787ef4036ffd',
				'label' => 'Data de Nascimento',
				'name' => 'birthday',
				'type' => 'date_picker',
				'date_format' => 'yymmdd',
				'display_format' => 'dd/mm/yy',
				'first_day' => 0,
			),
			array (
				'key' => 'field_5787ef6a36ffe',
				'label' => 'Nacionalidade',
				'name' => 'origin',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_5787ef9b36fff',
				'label' => 'Altura',
				'name' => 'height',
				'type' => 'number',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'min' => 0,
				'max' => '2.5',
				'step' => '',
			),
			array (
				'key' => 'field_5787efbb37000',
				'label' => 'Peso',
				'name' => 'weight',
				'type' => 'number',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'min' => 20,
				'max' => 150,
				'step' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'athlete',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_carreira',
		'title' => 'Carreira',
		'fields' => array (
			array (
				'key' => 'field_5787f018a7fc3',
				'label' => 'Carreira',
				'name' => 'carrer',
				'type' => 'textarea',
				'default_value' => '',
				'placeholder' => '',
				'maxlength' => '',
				'rows' => '',
				'formatting' => 'br',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'athlete',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_configuracoes',
		'title' => 'Configurações',
		'fields' => array (
			array (
				'key' => 'field_578df0c594e4e',
				'label' => 'Número de notícias na homepage',
				'name' => 'news_count',
				'type' => 'number',
				'required' => 1,
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'min' => '',
				'max' => '',
				'step' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'home',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_contactos',
		'title' => 'Contactos',
		'fields' => array (
			array (
				'key' => 'field_578de99ecdfaf',
				'label' => 'Telefone',
				'name' => 'phone',
				'type' => 'number',
				'required' => 1,
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'min' => '',
				'max' => '',
				'step' => '',
			),
			array (
				'key' => 'field_578de9bfcdfb0',
				'label' => 'Email',
				'name' => 'email',
				'type' => 'email',
				'required' => 1,
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'home',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_formacao',
		'title' => 'Formação',
		'fields' => array (
			array (
				'key' => 'field_5787eff764754',
				'label' => 'Formação',
				'name' => 'formation',
				'type' => 'textarea',
				'default_value' => '',
				'placeholder' => '',
				'maxlength' => '',
				'rows' => '',
				'formatting' => 'br',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'athlete',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_fotos-manchete',
		'title' => 'Fotos Manchete',
		'fields' => array (
			array (
				'key' => 'field_578b92533d9fa',
				'label' => 'Foto Mobile',
				'name' => 'mobile_photo',
				'type' => 'image_crop',
				'required' => 1,
				'crop_type' => 'hard',
				'target_size' => 'thumbnail',
				'width' => 479,
				'height' => 719,
				'preview_size' => 'thumbnail',
				'force_crop' => 'yes',
				'save_in_media_library' => 'yes',
				'retina_mode' => 'no',
				'save_format' => 'url',
			),
			array (
				'key' => 'field_578b929b3d9fb',
				'label' => 'Foto Tablet',
				'name' => 'tablet_photo',
				'type' => 'image_crop',
				'required' => 1,
				'crop_type' => 'hard',
				'target_size' => 'custom',
				'width' => 1023,
				'height' => 682,
				'preview_size' => 'thumbnail',
				'force_crop' => 'yes',
				'save_in_media_library' => 'yes',
				'retina_mode' => 'no',
				'save_format' => 'id',
			),
			array (
				'key' => 'field_578b92c73d9fc',
				'label' => 'Foto Fullscreen',
				'name' => 'fullscreen_photo',
				'type' => 'image_crop',
				'required' => 1,
				'crop_type' => 'hard',
				'target_size' => 'custom',
				'width' => 2000,
				'height' => 1000,
				'preview_size' => 'thumbnail',
				'force_crop' => 'yes',
				'save_in_media_library' => 'yes',
				'retina_mode' => 'no',
				'save_format' => 'url',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'highlight',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_gestao-atletas',
		'title' => 'Gestão Atletas',
		'fields' => array (
			array (
				'key' => 'field_5786d1cb2b8a2',
				'label' => 'Jogadores',
				'name' => 'players',
				'type' => 'relationship',
				'return_format' => 'object',
				'post_type' => array (
					0 => 'athlete',
				),
				'taxonomy' => array (
					0 => 'athlete_type:2',
				),
				'filters' => array (
					0 => 'search',
				),
				'result_elements' => array (
					0 => 'post_type',
					1 => 'post_title',
				),
				'max' => '',
			),
			array (
				'key' => 'field_5786d33604937',
				'label' => 'Treinadores',
				'name' => 'managers',
				'type' => 'relationship',
				'return_format' => 'object',
				'post_type' => array (
					0 => 'athlete',
				),
				'taxonomy' => array (
					0 => 'athlete_type:3',
				),
				'filters' => array (
					0 => 'search',
				),
				'result_elements' => array (
					0 => 'post_type',
					1 => 'post_title',
				),
				'max' => '',
			),
			array (
				'key' => 'field_5786d95a62c69',
				'label' => 'Equipas',
				'name' => 'teams',
				'type' => 'relationship',
				'return_format' => 'object',
				'post_type' => array (
					0 => 'athlete',
				),
				'taxonomy' => array (
					0 => 'athlete_type:4',
				),
				'filters' => array (
					0 => 'search',
				),
				'result_elements' => array (
					0 => 'post_type',
					1 => 'post_title',
				),
				'max' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'home',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_gestao-manchetes',
		'title' => 'Gestão Manchetes',
		'fields' => array (
			array (
				'key' => 'field_578dec0a37d83',
				'label' => 'Manchetes para a homepage',
				'name' => 'highlights_manager',
				'type' => 'relationship',
				'required' => 1,
				'return_format' => 'id',
				'post_type' => array (
					0 => 'highlight',
				),
				'taxonomy' => array (
					0 => 'all',
				),
				'filters' => array (
					0 => 'search',
				),
				'result_elements' => array (
					0 => 'post_type',
					1 => 'post_title',
				),
				'max' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'home',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'acf_after_title',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_gestao-servicos',
		'title' => 'Gestão Serviços',
		'fields' => array (
			array (
				'key' => 'field_5786cfc1e9109',
				'label' => 'Serviços',
				'name' => 'home_services',
				'type' => 'relationship',
				'return_format' => 'object',
				'post_type' => array (
					0 => 'service',
				),
				'taxonomy' => array (
					0 => 'all',
				),
				'filters' => array (
					0 => 'search',
				),
				'result_elements' => array (
					0 => 'post_type',
					1 => 'post_title',
				),
				'max' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'home',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_palmares',
		'title' => 'Palmarés',
		'fields' => array (
			array (
				'key' => 'field_5787efde2a0a4',
				'label' => 'Palmarés',
				'name' => 'prizes',
				'type' => 'textarea',
				'default_value' => '',
				'placeholder' => '',
				'maxlength' => '',
				'rows' => '',
				'formatting' => 'br',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'athlete',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_videos',
		'title' => 'Vídeos',
		'fields' => array (
			array (
				'key' => 'field_578772cd9d6bd',
				'label' => 'Videos do Atleta',
				'name' => 'athlete_videos',
				'type' => 'textarea',
				'default_value' => '',
				'placeholder' => '',
				'maxlength' => '',
				'rows' => '',
				'formatting' => 'none',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'athlete',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}
