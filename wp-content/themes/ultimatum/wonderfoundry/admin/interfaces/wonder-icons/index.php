<?php
function icons(){

$ccsconverter = array(
		"cssvar1" => "body",
		"cssvar2" => "idlogo-container",
		"cssvar3" => "h1",
		"cssvar4" => "h2",
		"cssvar5" => "h3",
		"cssvar6" => "h4",
		"cssvar7" => "h5",
		"cssvar8" => "h6",
		"cssvar9" => "a",
		"cssvar10" => "ahover",
		"cssvar11" => "h1classmulti-post-title",
		"cssvar12" => "classmulti-post-title",
		"cssvar13" => "divclasspost-inner",
		"cssvar14" => "classpost-inner",
		"cssvar15" => "classpost-header",
		"cssvar16" => "divclasspost-meta",
		"cssvar17" => "classpost-meta",
		"cssvar18" => "h2spaceaclasspost-title",
		"cssvar19" => "divclasspost-metavirgulspacedivclasspost-metaspacea",
		"cssvar20" => "divclasspost-taxonomyspacespan",
		"cssvar21" => "divclasspost-taxonomyspacea",
		"cssvar22" => "aclassreadmorecontent",
		"cssvar23" => "h3idcomments_title",
		"cssvar24" => "citeclasscomment_author",
		"cssvar25" => "divclasscomment_time",
		"cssvar26" => "divclasscomment_text",
		"cssvar27" => "aclasscomment-reply-linkvirgulspaceaclasscancel-comment-reply-link",
		"cssvar28" => "h3classrespond",
		"cssvar29" => "formidcommentformspacelabel",
		"cssvar30" => "divclassbreadcrumbs-plusspacepspacespanvirgulspacedivclassbreadcrumbs-plusspacepvirgulspacedivclassbreadcrumbs-plusspacepspacea",
		"cssvar31" => "divclassbreadcrumbs-plusspacepspacespanclassbreadcrumbs-title",
		"cssvar32" => "divclassbreadcrumbs-plusspacepspacestrong",
		"cssvar33" => "classwp-pagenavispaceavirgulspaceclasswp-pagenavispacespan",
		"cssvar34" => "classwp-pagenavispacespanclasscurrent",
		"cssvar35" => "divclasswp-pagenavispaceavirgulspacedivclasswp-pagenavispacespan",
		"cssvar36" => "divclasswp-pagenavispacespanclasscurrent",
		"cssvar37" => "classwfm-mega-menu",
		"cssvar38" => "classwfm-mega-menuspaceulspaceli_-hovervirgulspaceclasswfm-mega-menuspaceulspacelispaceclasssub-container",
		"cssvar39" => "classwfm-mega-menuspaceulspacelispaceclasssubspaceliclassmega-hdrspaceaclassmega-hdr-a",
		"cssvar40" => "classwfm-mega-menuspaceulspacelispaceclasssub-containerclassnon-megaspacelispacea_-hovervirgulspaceclasswfm-mega-menuspaceulspacelispaceclasssubspaceulclasssub-menuspacelispacea_-hover",
		"cssvar41" => "classwfm-mega-menuspaceulclassmenuspacelispacea",
		"cssvar42" => "classwfm-mega-menuspaceulclassmenuspaceli_-hoverspacea",
		"cssvar43" => "classwfm-mega-menuspaceulspacelispaceclasssubspaceliclassmega-hdrspaceaclassmega-hdr-a_-hover",
		"cssvar44" => "classwfm-mega-menuspaceulspacelispaceclasssubspaceulclasssub-menuspacelispacea",
		"cssvar45" => "classwfm-mega-menuspaceulspacelispaceclasssubspaceulclasssub-menuspacelispacea_-hover",
		"cssvar46" => "classwfm-mega-menuspaceulspacelispaceclasssub-containerclassnon-megaspacelispacea",
		"cssvar47" => "classwfm-mega-menuspaceulspacelispaceclasssub-containerclassnon-megaspacelispacea_-hover",
		"cssvar48" => "classddsmoothmenuh",
		"cssvar49" => "classddsmoothmenuhspaceulspacelispaceul",
		"cssvar50" => "classddsmoothmenuhspaceulspacelispacea",
		"cssvar51" => "classddsmoothmenuhspaceulspaceli_-hovervirgulclassddsmoothmenuhspaceulspacelispaceaclassselectedvirgulclassddsmoothmenuhspaceulspacelispacea_-hovervirgulclassddsmoothmenuhspaceulspacelispaceulclasssub-menuspacelivirgulspaceclassddsmoothmenuhspaceulspacelispaceulclasssub-menuspacelispacea",
		"cssvar52" => "classddsmoothmenuhspaceulspacelispaceulspaceli_-hovervirgulspaceclassddsmoothmenuhspaceulspacelispaceulspacelispacea_-hover",
		"cssvar53" => "classddsmoothmenuhspaceulspacelispacea_-linkvirgulclassddsmoothmenuhspaceulspacelispacea_-visited",
		"cssvar54" => "classddsmoothmenuhspaceulspacelispacea_-hover",
		"cssvar55" => "classddsmoothmenuhspaceulspacelispacespaceulspacelispacea_-linkvirgulclassddsmoothmenuhspaceulspacelispacespaceulspacelispacea_-visited",
		"cssvar56" => "classddsmoothmenuhspaceulspacelispacespaceulspacelispacea_-hover",
		"cssvar57" => "divclasshorizontal-menu",
		"cssvar58" => "divclasshorizontal-menuspaceulspacelispacea",
		"cssvar59" => "divclasshorizontal-menuspaceulspaceli_-hover",
		"cssvar60" => "divclasshorizontal-menuspaceulspaceli",
		"cssvar61" => "divclasshorizontal-menuspaceulspacelivirgulspacedivclasshorizontal-menuspaceulspacelispacea_-linkvirguldivclasshorizontal-menuspaceulspacelispacea_-visited",
		"cssvar62" => "divclasshorizontal-menuspaceulspacelispacea_-hover",
		"cssvar63" => "classwfm-vertical-mega-menu",
		"cssvar64" => "classwfm-vertical-mega-menuspaceulspaceli_-hovervirgulspaceclasswfm-vertical-mega-menuspaceulspacelispaceclasssub-container",
		"cssvar65" => "classwfm-vertical-mega-menuspaceulspacelispaceclasssubspaceliclassmega-hdrspaceaclassmega-hdr-a",
		"cssvar66" => "classwfm-vertical-mega-menuspaceulspacelispaceclasssub-containerclassnon-megaspacelispacea_-hovervirgulspaceclasswfm-vertical-mega-menuspaceulspacelispaceclasssubspaceulclasssub-menuspacelispacea_-hover",
		"cssvar67" => "classwfm-vertical-mega-menuspaceulspacelispacea",
		"cssvar68" => "classwfm-vertical-mega-menuspaceulspacelispacea_-hover",
		"cssvar69" => "classwfm-vertical-mega-menuspaceulspacelispaceclasssubspaceliclassmega-hdrspaceaclassmega-hdr-a_-hover",
		"cssvar70" => "classwfm-vertical-mega-menuspaceulspacelispaceclasssubspaceulclasssub-menuspacelispacea",
		"cssvar71" => "classwfm-vertical-mega-menuspaceulspacelispaceclasssubspaceulclasssub-menuspacelispacea_-hover",
		"cssvar72" => "classwfm-vertical-mega-menuspaceulspacelispaceclasssub-containerclassnon-megaspacelispacea",
		"cssvar73" => "classwfm-vertical-mega-menuspaceulspacelispaceclasssub-containerclassnon-megaspacelispacea_-hover",
		"cssvar74" => "classddsmoothmenuv",
		"cssvar75" => "classddsmoothmenuvspaceulspacelispacea_-linkvirgulclassddsmoothmenuvspaceulspacelispacea_-visitedvirgulclassddsmoothmenuvspaceulspacelispacea_-active",
		"cssvar76" => "classddsmoothmenuvspaceulspaceli_-hovervirgulclassddsmoothmenuvspaceulspacelispaceaclassselectedvirgulclassddsmoothmenuvspaceulspacelispacea_-hovervirgulclassddsmoothmenuvspaceulspacelispaceulclasssub-menuspacelivirgulspaceclassddsmoothmenuvspaceulspacelispaceulclasssub-menuspacelispacea",
		"cssvar77" => "classddsmoothmenuvspaceulspacelispaceulspaceli_-hovervirgulspaceclassddsmoothmenuvspaceulspacelispaceulspacelispacea_-hover",
		"cssvar78" => "classddsmoothmenuvspaceulspacelispacea_-linkvirgulclassddsmoothmenuvspaceulspacelispacea_-visited",
		"cssvar79" => "classddsmoothmenuvspaceulspacelispacea_-hover",
		"cssvar80" => "classddsmoothmenuvspaceulspacelispacespaceulspacelispacea_-linkvirgulclassddsmoothmenuvspaceulspacelispacespaceulspacelispacea_-visited",
		"cssvar81" => "classddsmoothmenuvspaceulspacelispacespaceulspacelispacea_-hover",
		"cssvar82" => "classvertical-menuspacea",
		"cssvar83" => "divclassvertical-menuspacea_-hover",
		"cssvar84" => "classvertical-menuspacea_-linkvirgulclassvertical-menuspacea_-visited",
		"cssvar85" => "classvertical-menuspacea_-hover",
		"cssvar86" => "ulclasstabsspacelispacea",
		"cssvar87" => "ulclasstabsspacelispacea_-hover",
		"cssvar88" => "ulclasstabsspacelispaceaclasscurrent",
		"cssvar89" => "divclasstabs-wrapperspacedivclasspanes",
		"cssvar90" => "classaccordion-toggle",
		"cssvar91" => "classaccordionspaceclasscurrent",
		"cssvar92" => "divclassaccordionspacedivclasspane",
		"cssvar93" => "h4classaccordion-toggle",
		"cssvar94" => "classtoggle_title",
		"cssvar95" => "classacctogg_active",
		"cssvar96" => "divclasstoggle",
		"cssvar97" => "classtoggle_titlespaceaclasstoggle-title",
		"cssvar98" => "divclasstoggle_content",
		"cssvar99" => "h2classslidertitle",
		"cssvar100" => "pclassslidertext",
		"cssvar101" => "classslidedeckspace>spacedt",
		"cssvar102" => "h1classsuper-title",
		"cssvar103" => "h3classelement-title",
		"cssvar104" => "classelement-title",
		"cssvar105" => "h3classslidertitle",
		"cssvar106" => "classanyCaptionspaceh3classslidertitlevirgulspaceclasss3captionspaceh3classslidertitle",
		"cssvar107" => "classanyCaptionspacepclassslidertextvirgulspaceclasss3captionspacepclassslidertext",
		"cssvar108" => "aidlogo",
		"cssvar109" => "spanidtagline",
		"cssvar110" => "blockquote",
		"cssvar111" => "classwfm-mega-menuspaceulspaceliclasscurrent-menu-ancestorvirgulspaceclasswfm-mega-menuspaceulspaceliclasscurrent-menu-item",
		"cssvar112" => "classwfm-mega-menuspaceulspaceliclasscurrent-menu-ancestorspaceavirgulspaceclasswfm-mega-menuspaceulspaceliclasscurrent-menu-itemspacea"
		
		);
$cssvar = array(
		"cssvar1" => "body",
		"cssvar2" => "#logo-container",
		"cssvar3" => "h1, h1 a, h1 a:hover, h1 a:visited",
		"cssvar4" => "h2, h2 a, h2 a:hover, h2 a:visited",
		"cssvar5" => "h3, h3 a, h3 a:hover, h3 a:visited",
		"cssvar6" => "h4, h4 a, h4 a:hover, h4 a:visited",
		"cssvar7" => "h5, h5 a, h5 a:hover, h5 a:visited",
		"cssvar8" => "h6, h6 a, h6 a:hover, h6 a:visited",
		"cssvar9" => "a",
		"cssvar10" => "a:hover",
		"cssvar11" => "h1.multi-post-title, h1.multi-post-title a, h1.multi-post-title a:hover, h1.multi-post-title a:visited",
		"cssvar12" => ".multi-post-title",
		"cssvar13" => "div.post-inner",
		"cssvar14" => ".post-inner",
		"cssvar15" => ".post-header",
		"cssvar16" => "div.post-meta",
		"cssvar17" => ".post-meta",
		"cssvar18" => "h2 a.post-title, h2 a.post-title a, h2 a.post-title a:hover, h2 a.post-title a:visited",
		"cssvar19" => "div.post-meta, div.post-meta a",
		"cssvar20" => "div.post-taxonomy span",
		"cssvar21" => "div.post-taxonomy a",
		"cssvar22" => "a.readmorecontent",
		"cssvar23" => "h3#comments_title, h3#comments_title a, h3#comments_title a:hover, h3#comments_title a:visited",
		"cssvar24" => "cite.comment_author",
		"cssvar25" => "div.comment_time",
		"cssvar26" => "div.comment_text",
		"cssvar27" => "a.comment-reply-link, a.cancel-comment-reply-link",
		"cssvar28" => "h3.respond, h3.respond a, h3.respond a:hover, h3.respond a:visited",
		"cssvar29" => "form#commentform label",
		"cssvar30" => "div.breadcrumbs-plus p span, div.breadcrumbs-plus p, div.breadcrumbs-plus p a",
		"cssvar31" => "div.breadcrumbs-plus p span.breadcrumbs-title",
		"cssvar32" => "div.breadcrumbs-plus p strong",
		"cssvar33" => ".wp-pagenavi a, .wp-pagenavi span",
		"cssvar34" => ".wp-pagenavi span.current",
		"cssvar35" => "div.wp-pagenavi a, div.wp-pagenavi span",
		"cssvar36" => "div.wp-pagenavi span.current",
		"cssvar37" => ".wfm-mega-menu",
		"cssvar38" => ".wfm-mega-menu ul li:hover, .wfm-mega-menu ul li .sub-container",
		"cssvar39" => ".wfm-mega-menu ul li .sub li.mega-hdr a.mega-hdr-a",
		"cssvar40" => ".wfm-mega-menu ul li .sub-container.non-mega li a:hover, .wfm-mega-menu ul li .sub ul.sub-menu li a:hover",
		"cssvar41" => ".wfm-mega-menu ul.menu li a",
		"cssvar42" => ".wfm-mega-menu ul.menu li:hover a",
		"cssvar43" => ".wfm-mega-menu ul li .sub li.mega-hdr a.mega-hdr-a:hover",
		"cssvar44" => ".wfm-mega-menu ul li .sub ul.sub-menu li a",
		"cssvar45" => ".wfm-mega-menu ul li .sub ul.sub-menu li a:hover",
		"cssvar46" => ".wfm-mega-menu ul li .sub-container.non-mega li a",
		"cssvar47" => ".wfm-mega-menu ul li .sub-container.non-mega li a:hover",
		"cssvar48" => ".ddsmoothmenuh",
		"cssvar49" => ".ddsmoothmenuh ul li ul",
		"cssvar50" => ".ddsmoothmenuh ul li a",
		"cssvar51" => ".ddsmoothmenuh ul li:hover,.ddsmoothmenuh ul li a.selected,.ddsmoothmenuh ul li a:hover,.ddsmoothmenuh ul li ul.sub-menu li, .ddsmoothmenuh ul li ul.sub-menu li a",
		"cssvar52" => ".ddsmoothmenuh ul li ul li:hover, .ddsmoothmenuh ul li ul li a:hover",
		"cssvar53" => ".ddsmoothmenuh ul li a:link,.ddsmoothmenuh ul li a:visited",
		"cssvar54" => ".ddsmoothmenuh ul li a:hover",
		"cssvar55" => ".ddsmoothmenuh ul li  ul li a:link,.ddsmoothmenuh ul li  ul li a:visited",
		"cssvar56" => ".ddsmoothmenuh ul li  ul li a:hover",
		"cssvar57" => "div.horizontal-menu",
		"cssvar58" => "div.horizontal-menu ul li a",
		"cssvar59" => "div.horizontal-menu ul li:hover",
		"cssvar60" => "div.horizontal-menu ul li",
		"cssvar61" => "div.horizontal-menu ul li, div.horizontal-menu ul li a:link,div.horizontal-menu ul li a:visited",
		"cssvar62" => "div.horizontal-menu ul li a:hover",
		"cssvar63" => ".wfm-vertical-mega-menu",
		"cssvar64" => ".wfm-vertical-mega-menu ul li:hover, .wfm-vertical-mega-menu ul li .sub-container",
		"cssvar65" => ".wfm-vertical-mega-menu ul li .sub li.mega-hdr a.mega-hdr-a",
		"cssvar66" => ".wfm-vertical-mega-menu ul li .sub-container.non-mega li a:hover, .wfm-vertical-mega-menu ul li .sub ul.sub-menu li a:hover",
		"cssvar67" => ".wfm-vertical-mega-menu ul li a",
		"cssvar68" => ".wfm-vertical-mega-menu ul li a:hover",
		"cssvar69" => ".wfm-vertical-mega-menu ul li .sub li.mega-hdr a.mega-hdr-a:hover",
		"cssvar70" => ".wfm-vertical-mega-menu ul li .sub ul.sub-menu li a",
		"cssvar71" => ".wfm-vertical-mega-menu ul li .sub ul.sub-menu li a:hover",
		"cssvar72" => ".wfm-vertical-mega-menu ul li .sub-container.non-mega li a",
		"cssvar73" => ".wfm-vertical-mega-menu ul li .sub-container.non-mega li a:hover",
		"cssvar74" => ".ddsmoothmenuv",
		"cssvar75" => ".ddsmoothmenuv ul li a:link,.ddsmoothmenuv ul li a:visited,.ddsmoothmenuv ul li a:active",
		"cssvar76" => ".ddsmoothmenuv ul li:hover,.ddsmoothmenuv ul li a.selected,.ddsmoothmenuv ul li a:hover,.ddsmoothmenuv ul li ul.sub-menu li, .ddsmoothmenuv ul li ul.sub-menu li a",
		"cssvar77" => ".ddsmoothmenuv ul li ul li:hover, .ddsmoothmenuv ul li ul li a:hover",
		"cssvar78" => ".ddsmoothmenuv ul li a:link,.ddsmoothmenuv ul li a:visited",
		"cssvar79" => ".ddsmoothmenuv ul li a:hover",
		"cssvar80" => ".ddsmoothmenuv ul li  ul li a:link,.ddsmoothmenuv ul li  ul li a:visited",
		"cssvar81" => ".ddsmoothmenuv ul li  ul li a:hover",
		"cssvar82" => ".vertical-menu a",
		"cssvar83" => "div.vertical-menu a:hover",
		"cssvar84" => ".vertical-menu a:link,.vertical-menu a:visited",
		"cssvar85" => ".vertical-menu a:hover",
		"cssvar86" => "ul.tabs li a",
		"cssvar87" => "ul.tabs li a:hover",
		"cssvar88" => "ul.tabs li a.current",
		"cssvar89" => "div.tabs-wrapper div.panes",
		"cssvar90" => ".accordion-toggle",
		"cssvar91" => ".accordion .current",
		"cssvar92" => "div.accordion div.pane",
		"cssvar93" => "h4.accordion-toggle, h4.accordion-toggle a, h4.accordion-toggle a:hover, h4.accordion-toggle a:visited",
		"cssvar94" => ".toggle_title",
		"cssvar95" => ".acctogg_active",
		"cssvar96" => "div.toggle",
		"cssvar97" => ".toggle_title a.toggle-title",
		"cssvar98" => "div.toggle_content",
		"cssvar99" => "h2.slidertitle, h2.slidertitle a, h2.slidertitle a:hover, h2.slidertitle a:visited",
		"cssvar100" => "p.slidertext",
		"cssvar101" => ".slidedeck > dt",
		"cssvar102" => "h1.super-title, h1.super-title a, h1.super-title a:hover, h1.super-title a:visited",
		"cssvar103" => "h3.element-title, h3.element-title a, h3.element-title a:hover, h3.element-title a:visited",
		"cssvar104" => ".element-title",
		"cssvar105" => "h3.slidertitle, h3.slidertitle a, h3.slidertitle a:hover, h3.slidertitle a:visited",
		"cssvar106" => ".anyCaption h3.slidertitle, .s3caption h3.slidertitle, .anyCaption h3.slidertitle, .s3caption h3.slidertitle a, .anyCaption h3.slidertitle, .s3caption h3.slidertitle a:hover, .anyCaption h3.slidertitle, .s3caption h3.slidertitle a:visited",
		"cssvar107" => ".anyCaption p.slidertext, .s3caption p.slidertext",
		"cssvar108" => "a#logo",
		"cssvar109" => "span#tagline",
		"cssvar110" => "blockquote",
		"cssvar111" => ".wfm-mega-menu ul li.current-menu-ancestor, .wfm-mega-menu ul li.current-menu-item",
		"cssvar112" => ".wfm-mega-menu ul li.current-menu-ancestor a, .wfm-mega-menu ul li.current-menu-item a"
		);
$css= get_option('ultimatum_1_css');
screen_icon();
echo '<div class="wrap"><pre>';
$content = file_get_contents(THEME_CACHE_DIR."/cssvars.txt");
foreach ($ccsconverter as $el=>$value){
	$content = str_replace('"'.$value.'"','"'.$el.'"',$content); 
}
print $content;
echo '</pre></div>';
}