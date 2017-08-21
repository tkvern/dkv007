<krpano version="1.19" title="量子视觉云">

	<include url="/vrplay/skin/vtourskin.xml" />

	<!-- customize skin settings: maps, gyro, webvr, thumbnails, tooltips, layout, design, ... -->
	<skin_settings maps="false"
	               maps_type="google"
	               maps_bing_api_key=""
	               maps_google_api_key=""
	               maps_zoombuttons="false"
	               gyro="true"
	               webvr="true"
	               webvr_gyro_keeplookingdirection="false"
	               webvr_prev_next_hotspots="false"
	               littleplanetintro="true"
	               title="false"
	               thumbs="true"
	               thumbs_width="60" thumbs_height="40" thumbs_padding="10" thumbs_crop="0|40|240|160"
	               thumbs_opened="true"
	               thumbs_text="true"
	               thumbs_dragging="true"
	               thumbs_onhoverscrolling="false"
	               thumbs_scrollbuttons="false"
	               thumbs_scrollindicator="false"
	               thumbs_loop="false"
	               tooltips_buttons="false"
	               tooltips_thumbs="false"
	               tooltips_hotspots="false"
	               tooltips_mapspots="false"
	               deeplinking="false"
	               loadscene_flags="MERGE"
	               loadscene_blend="OPENBLEND(0.5, 0.0, 0.75, 0.05, linear)"
	               loadscene_blend_prev="SLIDEBLEND(0.5, 180, 0.75, linear)"
	               loadscene_blend_next="SLIDEBLEND(0.5,   0, 0.75, linear)"
	               loadingtext="loading..."
	               layout_width="100%"
	               layout_maxwidth="814"
	               controlbar_width="-24"
	               controlbar_height="40"
	               controlbar_offset="20"
	               controlbar_offset_closed="-40"
	               controlbar_overlap.no-fractionalscaling="10"
	               controlbar_overlap.fractionalscaling="0"
	               design_skin_images="vtourskin.png"
	               design_bgcolor="0x2D3E50"
	               design_bgalpha="0.8"
	               design_bgborder="0"
	               design_bgroundedge="1"
	               design_bgshadow="0 4 10 0x000000 0.3"
	               design_thumbborder_bgborder="3 0xFFFFFF 1.0"
	               design_thumbborder_padding="2"
	               design_thumbborder_bgroundedge="0"
	               design_text_css="color:#FFFFFF; font-family:Arial;"
	               design_text_shadow="1"
	               />

	<!--
	    For an alternative skin design either change the <skin_settings> values 
	    from above or optionally include one of the predefined designs from below.
	-->
	<!-- <include url="skin/vtourskin_design_flat_light.xml"  /> -->
	<!-- <include url="skin/vtourskin_design_glass.xml"       /> -->
	<!-- <include url="skin/vtourskin_design_ultra_light.xml" /> -->
	<!-- <include url="skin/vtourskin_design_117.xml"         /> -->
	<!-- <include url="skin/vtourskin_design_117round.xml"    /> -->
	<!-- <include url="skin/vtourskin_design_black.xml"       /> -->


	<!-- startup action - load the first scene -->
	<action name="startup" autorun="onstart">
		if(startscene === null OR !scene[get(startscene)], copy(startscene,scene[0].name); );
		loadscene(get(startscene), null, MERGE);
		if(startactions !== null, startactions() );
	</action>

	@foreach($images as $image)
		<scene name="scene_{{$image->key}}" title="{{$image->title}}" onstart="" thumburl="/storage/vr/file/{{$image->user_id}}/{{$image->key}}/vtour/panos/{{$image->key}}.tiles/thumb.jpg" lat="" lng="" heading="">

			<view hlookat="0.0" vlookat="0.0" fovtype="MFOV" fov="120" maxpixelzoom="2.0" fovmin="70" fovmax="140" limitview="auto" />

			<preview url="/storage/vr/file/{{$image->user_id}}/{{$image->key}}/vtour/panos/{{$image->key}}.tiles/preview.jpg" />

			<image type="CUBE" multires="true" tilesize="512">
				<level tiledimagewidth="2624" tiledimageheight="2624">
					<cube url="/storage/vr/file/{{$image->user_id}}/{{$image->key}}/vtour/panos/{{$image->key}}.tiles/%s/l3/%v/l3_%s_%v_%h.jpg" />
				</level>
				<level tiledimagewidth="1280" tiledimageheight="1280">
					<cube url="/storage/vr/file/{{$image->user_id}}/{{$image->key}}/vtour/panos/{{$image->key}}.tiles/%s/l2/%v/l2_%s_%v_%h.jpg" />
				</level>
				<level tiledimagewidth="640" tiledimageheight="640">
					<cube url="/storage/vr/file/{{$image->user_id}}/{{$image->key}}/vtour/panos/{{$image->key}}.tiles/%s/l1/%v/l1_%s_%v_%h.jpg" />
				</level>
			</image>

		</scene>
	@endforeach
</krpano>