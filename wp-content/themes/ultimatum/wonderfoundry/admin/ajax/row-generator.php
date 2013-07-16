<li id="row-<?php echo $row["id"];?>" class="rowsoflayout">
<?php switch($row["type_id"]){ ?>
<?php case '1': ?>
<table width="100%" cellpadding="0" cellspacing="5" style="background:#E0E0E0;border-radius:10px;">
<tr valign="top">
<td style="width:22px;">
<div class="drag"></div></td><td><table class="admin_preview" width="100%">
	<tr valign="top">
		<td width="100%">
			<table class="widefat">
			<tr>
				<th><div class="colinfo">#<?php echo 'col-'.$row["id"].'-1';?></div><div class="editcolcss"><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'col-'.$row["id"].'-1';?>&modal=true&TB_iframe=1&width=640&height=380">Column CSS</a></div></th>
			</tr>
			<tr>
				<td><?php ultimate_wp_list_widget_controls('sidebar-'.$row["id"].'-1');?></td>
			</tr>
			</table>
		</td>
	</tr>	
</table>
</td>
<td width="25">
<table class="editrows">
	<tr valign="top">
		<td>
		
		<p>
			<a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'wrapper-'.$row["id"];?>&modal=true&TB_iframe=1&width=640&height=380">
				Wrapper CSS 
			</a>
		</p>
		<p><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'container-'.$row["id"];?>&modal=true&TB_iframe=1&width=640&height=380">Container CSS</a>
		<br />
		</p></td></tr><tr valign="bottom"><td><div class="button-secondary delete-item">Delete</div></td></tr></table>
</td>
</tr>
</table>
<?php break; ?>
<?php case '2': ?>
<table width="100%" cellpadding="0" cellspacing="5" style="background:#E0E0E0;border-radius:10px;">
<tr valign="top">
<td style="width:22px;">
<div class="drag"></div></td><td><table class="admin_preview" width="100%">
	<tr valign="top">
		<td width="25%">
			<table class="widefat">
			<tr>
				<th><div class="colinfo">#<?php echo 'col-'.$row["id"].'-1';?></div><div class="editcolcss"><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'col-'.$row["id"].'-1';?>&modal=true&TB_iframe=1&width=640&height=380">Column CSS</a></div></th>
			</tr>
			<tr>
				<td><?php ultimate_wp_list_widget_controls('sidebar-'.$row["id"].'-1');?></td>
			</tr>
			</table>
		</td>
		<td width="25%">
			<table class="widefat">
			<tr>
				<th><div class="colinfo">#<?php echo 'col-'.$row["id"].'-2';?></div><div class="editcolcss"><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'col-'.$row["id"].'-2';?>&modal=true&TB_iframe=1&width=640&height=380">Column CSS</a></div></th>
			</tr>
			<tr>
				<td><?php ultimate_wp_list_widget_controls('sidebar-'.$row["id"].'-2');?></td>
			</tr>
			</table>
		</td>
		<td width="25%">
			<table class="widefat">
			<tr>
				<th><div class="colinfo">#<?php echo 'col-'.$row["id"].'-3';?></div><div class="editcolcss"><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'col-'.$row["id"].'-3';?>&modal=true&TB_iframe=1&width=640&height=380">Column CSS</a></div></th>
			</tr>
			<tr>
				<td><?php ultimate_wp_list_widget_controls('sidebar-'.$row["id"].'-3');?></td>
			</tr>
			</table>
		</td>
		<td width="25%">
			<table class="widefat">
			<tr>
				<th><div class="colinfo">#<?php echo 'col-'.$row["id"].'-4';?></div><div class="editcolcss"><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'col-'.$row["id"].'-4';?>&modal=true&TB_iframe=1&width=640&height=380">Column CSS</a></div></th>
			</tr>
			<tr>
				<td><?php ultimate_wp_list_widget_controls('sidebar-'.$row["id"].'-4');?></td>
			</tr>
			</table>
		</td>	
	</tr>	
</table>
</td>
<td width="25">
<table class="editrows"><tr valign="top"><td><p><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'wrapper-'.$row["id"];?>&modal=true&TB_iframe=1&width=640&height=380">Wrapper CSS</a></p>
<p><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'container-'.$row["id"];?>&modal=true&TB_iframe=1&width=640&height=380">Container CSS</a></p></td></tr><tr valign="bottom"><td><div class="button-secondary delete-item">Delete</div></td></tr></table>
</td>
</tr>
</table>
<?php break; ?>
<?php case '3':?>
<table width="100%" cellpadding="0" cellspacing="5" style="background:#E0E0E0;border-radius:10px;">
<tr valign="top">
<td style="width:22px;">
<div class="drag"></div></td><td><table class="admin_preview" width="100%">
	<tr valign="top">
		<td width="33%">
			<table class="widefat">
			<tr>
				<th><div class="colinfo">#<?php echo 'col-'.$row["id"].'-1';?></div><div class="editcolcss"><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'col-'.$row["id"].'-1';?>&modal=true&TB_iframe=1&width=640&height=380">Column CSS</a></div></th>
			</tr>
			<tr>
				<td><?php ultimate_wp_list_widget_controls('sidebar-'.$row["id"].'-1');?></td>
			</tr>
			</table>
		</td>
		<td width="33%">
			<table class="widefat">
			<tr>
				<th><div class="colinfo">#<?php echo 'col-'.$row["id"].'-2';?></div><div class="editcolcss"><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'col-'.$row["id"].'-2';?>&modal=true&TB_iframe=1&width=640&height=380">Column CSS</a></div></th>
			</tr>
			<tr>
				<td><?php ultimate_wp_list_widget_controls('sidebar-'.$row["id"].'-2');?></td>
			</tr>
			</table>
		</td>
		<td width="33%">
			<table class="widefat">
			<tr>
				<th><div class="colinfo">#<?php echo 'col-'.$row["id"].'-3';?></div><div class="editcolcss"><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'col-'.$row["id"].'-3';?>&modal=true&TB_iframe=1&width=640&height=380">Column CSS</a></div></th>
			</tr>
			<tr>
				<td><?php ultimate_wp_list_widget_controls('sidebar-'.$row["id"].'-3');?></td>
			</tr>
			</table>
		</td>
	</tr>	
</table>
</td>
<td width="25">
<table class="editrows"><tr valign="top"><td><p><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'wrapper-'.$row["id"];?>&modal=true&TB_iframe=1&width=640&height=380">Wrapper CSS</a></p>
<p><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'container-'.$row["id"];?>&modal=true&TB_iframe=1&width=640&height=380">Container CSS</a></p></td></tr><tr valign="bottom"><td><div class="button-secondary delete-item">Delete</div></td></tr></table>
</td>
</tr>
</table>
<?php break; ?>
<?php case '4':?>
<table width="100%" cellpadding="0" cellspacing="5" style="background:#E0E0E0;border-radius:10px;">
<tr valign="top">
<td style="width:22px;">
<div class="drag"></div></td><td><table class="admin_preview" width="100%">
	<tr valign="top">
		<td width="50%">
			<table class="widefat">
			<tr>
				<th><div class="colinfo">#<?php echo 'col-'.$row["id"].'-1';?></div><div class="editcolcss"><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'col-'.$row["id"].'-1';?>&modal=true&TB_iframe=1&width=640&height=380">Column CSS</a></div></th>
			</tr>
			<tr>
				<td><?php ultimate_wp_list_widget_controls('sidebar-'.$row["id"].'-1');?></td>
			</tr>
			</table>
		</td>
		<td width="50%">
			<table class="widefat">
			<tr>
				<th><div class="colinfo">#<?php echo 'col-'.$row["id"].'-2';?></div><div class="editcolcss"><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'col-'.$row["id"].'-2';?>&modal=true&TB_iframe=1&width=640&height=380">Column CSS</a></div></th>
			</tr>
			<tr>
				<td><?php ultimate_wp_list_widget_controls('sidebar-'.$row["id"].'-2');?></td>
			</tr>
			</table>
		</td>
	</tr>	
</table>
</td>
<td width="25">
<table class="editrows"><tr valign="top"><td><p><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'wrapper-'.$row["id"];?>&modal=true&TB_iframe=1&width=640&height=380">Wrapper CSS</a></p>
<p><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'container-'.$row["id"];?>&modal=true&TB_iframe=1&width=640&height=380">Container CSS</a></p></td></tr><tr valign="bottom"><td><div class="button-secondary delete-item">Delete</div></td></tr></table>
</td>
</tr>
</table>
<?php break; ?>
<?php case '5': ?>
<table width="100%" cellpadding="0" cellspacing="5" style="background:#E0E0E0;border-radius:10px;">
<tr valign="top">
<td style="width:22px;">
<div class="drag"></div></td><td><table class="admin_preview" width="100%">
	<tr valign="top">
		<td width="25%">
			<table class="widefat">
			<tr>
				<th><div class="colinfo">#<?php echo 'col-'.$row["id"].'-1';?></div><div class="editcolcss"><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'col-'.$row["id"].'-1';?>&modal=true&TB_iframe=1&width=640&height=380">Column CSS</a></div></th>
			</tr>
			<tr>
				<td><?php ultimate_wp_list_widget_controls('sidebar-'.$row["id"].'-1');?></td>
			</tr>
			</table>
		</td>
		<td width="25%">
			<table class="widefat">
			<tr>
				<th><div class="colinfo">#<?php echo 'col-'.$row["id"].'-2';?></div><div class="editcolcss"><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'col-'.$row["id"].'-2';?>&modal=true&TB_iframe=1&width=640&height=380">Column CSS</a></div></th>
			</tr>
			<tr>
				<td><?php ultimate_wp_list_widget_controls('sidebar-'.$row["id"].'-2');?></td>
			</tr>
			</table>
		</td>
		<td width="50%">
			<table class="widefat">
			<tr>
				<th><div class="colinfo">#<?php echo 'col-'.$row["id"].'-3';?></div><div class="editcolcss"><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'col-'.$row["id"].'-3';?>&modal=true&TB_iframe=1&width=640&height=380">Column CSS</a></div></th>
			</tr>
			<tr>
				<td><?php ultimate_wp_list_widget_controls('sidebar-'.$row["id"].'-3');?></td>
			</tr>
			</table>
		</td>
	</tr>	
</table>
</td>
<td width="25">
<table class="editrows"><tr valign="top"><td><p><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'wrapper-'.$row["id"];?>&modal=true&TB_iframe=1&width=640&height=380">Wrapper CSS</a></p>
<p><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'container-'.$row["id"];?>&modal=true&TB_iframe=1&width=640&height=380">Container CSS</a></p></td></tr><tr valign="bottom"><td><div class="button-secondary delete-item">Delete</div></td></tr></table>
</td>
</tr>
</table>
<?php break; ?>
<?php case '6': ?>
<table width="100%" cellpadding="0" cellspacing="5" style="background:#E0E0E0;border-radius:10px;">
<tr valign="top">
<td style="width:22px;">
<div class="drag"></div></td><td><table class="admin_preview" width="100%">
	<tr valign="top">
		<td width="50%">
			<table class="widefat">
			<tr>
				<th><div class="colinfo">#<?php echo 'col-'.$row["id"].'-1';?></div><div class="editcolcss"><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'col-'.$row["id"].'-1';?>&modal=true&TB_iframe=1&width=640&height=380">Column CSS</a></div></th>
			</tr>
			<tr>
				<td><?php ultimate_wp_list_widget_controls('sidebar-'.$row["id"].'-1');?></td>
			</tr>
			</table>
		</td>
		<td width="25%">
			<table class="widefat">
			<tr>
				<th><div class="colinfo">#<?php echo 'col-'.$row["id"].'-2';?></div><div class="editcolcss"><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'col-'.$row["id"].'-2';?>&modal=true&TB_iframe=1&width=640&height=380">Column CSS</a></div></th>
			</tr>
			<tr>
				<td><?php ultimate_wp_list_widget_controls('sidebar-'.$row["id"].'-2');?></td>
			</tr>
			</table>
		</td>
		<td width="25%">
			<table class="widefat">
			<tr>
				<th><div class="colinfo">#<?php echo 'col-'.$row["id"].'-3';?></div><div class="editcolcss"><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'col-'.$row["id"].'-3';?>&modal=true&TB_iframe=1&width=640&height=380">Column CSS</a></div></th>
			</tr>
			<tr>
				<td><?php ultimate_wp_list_widget_controls('sidebar-'.$row["id"].'-3');?></td>
			</tr>
			</table>
		</td>
	</tr>	
</table>
</td>
<td width="25">
<table class="editrows"><tr valign="top"><td><p><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'wrapper-'.$row["id"];?>&modal=true&TB_iframe=1&width=640&height=380">Wrapper CSS</a></p>
<p><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'container-'.$row["id"];?>&modal=true&TB_iframe=1&width=640&height=380">Container CSS</a></p></td></tr><tr valign="bottom"><td><div class="button-secondary delete-item">Delete</div></td></tr></table>
</td>
</tr>
</table>
<?php break; ?>
<?php case '7': ?>
<table width="100%" cellpadding="0" cellspacing="5" style="background:#E0E0E0;border-radius:10px;">
<tr valign="top">
<td style="width:22px;">
<div class="drag"></div></td><td><table class="admin_preview" width="100%">
<tr valign="top">
		<td width="25%">
			<table class="widefat">
			<tr>
				<th><div class="colinfo">#<?php echo 'col-'.$row["id"].'-1';?></div><div class="editcolcss"><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'col-'.$row["id"].'-1';?>&modal=true&TB_iframe=1&width=640&height=380">Column CSS</a></div></th>
			</tr>
			<tr>
				<td><?php ultimate_wp_list_widget_controls('sidebar-'.$row["id"].'-1');?></td>
			</tr>
			</table>
		</td>
		<td width="50%">
			<table class="widefat">
			<tr>
				<th><div class="colinfo">#<?php echo 'col-'.$row["id"].'-2';?></div><div class="editcolcss"><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'col-'.$row["id"].'-2';?>&modal=true&TB_iframe=1&width=640&height=380">Column CSS</a></div></th>
			</tr>
			<tr>
				<td><?php ultimate_wp_list_widget_controls('sidebar-'.$row["id"].'-2');?></td>
			</tr>
			</table>
		</td>
		<td width="25%">
			<table class="widefat">
			<tr>
				<th><div class="colinfo">#<?php echo 'col-'.$row["id"].'-3';?></div><div class="editcolcss"><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'col-'.$row["id"].'-3';?>&modal=true&TB_iframe=1&width=640&height=380">Column CSS</a></div></th>
			</tr>
			<tr>
				<td><?php ultimate_wp_list_widget_controls('sidebar-'.$row["id"].'-3');?></td>
			</tr>
			</table>
		</td>
	</tr>	
</table>
</td>
<td width="25">
<table class="editrows"><tr valign="top"><td><p><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'wrapper-'.$row["id"];?>&modal=true&TB_iframe=1&width=640&height=380">Wrapper CSS</a></p>
<p><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'container-'.$row["id"];?>&modal=true&TB_iframe=1&width=640&height=380">Container CSS</a></p></td></tr><tr valign="bottom"><td><div class="button-secondary delete-item">Delete</div></td></tr></table>
</td>
</tr>
</table>
<?php break; ?>
<?php case '8':?>
<table width="100%" cellpadding="0" cellspacing="5" style="background:#E0E0E0;border-radius:10px;">
<tr valign="top">
<td style="width:22px;">
<div class="drag"></div></td><td><table class="admin_preview" width="100%">
<tr valign="top">
		<td width="25%">
			<table class="widefat">
			<tr>
				<th><div class="colinfo">#<?php echo 'col-'.$row["id"].'-1';?></div><div class="editcolcss"><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'col-'.$row["id"].'-1';?>&modal=true&TB_iframe=1&width=640&height=380">Column CSS</a></div></th>
			</tr>
			<tr>
				<td><?php ultimate_wp_list_widget_controls('sidebar-'.$row["id"].'-1');?></td>
			</tr>
			</table>
		</td>
		<td width="75%">
			<table class="widefat">
			<tr>
				<th><div class="colinfo">#<?php echo 'col-'.$row["id"].'-2';?></div><div class="editcolcss"><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'col-'.$row["id"].'-2';?>&modal=true&TB_iframe=1&width=640&height=380">Column CSS</a></div></th>
			</tr>
			<tr>
				<td><?php ultimate_wp_list_widget_controls('sidebar-'.$row["id"].'-2');?></td>
			</tr>
			</table>
		</td>
	</tr>	
</table>
</td>
<td width="25">
<table class="editrows"><tr valign="top"><td><p><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'wrapper-'.$row["id"];?>&modal=true&TB_iframe=1&width=640&height=380">Wrapper CSS</a></p>
<p><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'container-'.$row["id"];?>&modal=true&TB_iframe=1&width=640&height=380">Container CSS</a></p></td></tr><tr valign="bottom"><td><div class="button-secondary delete-item">Delete</div></td></tr></table>
</td>
</tr>
</table>
<?php break; ?>
<?php case '9':?>
<table width="100%" cellpadding="0" cellspacing="5" style="background:#E0E0E0;border-radius:10px;">
<tr valign="top">
<td style="width:22px;">
<div class="drag"></div></td><td><table class="admin_preview" width="100%">
<tr valign="top">
		<td width="75%">
			<table class="widefat">
			<tr>
				<th><div class="colinfo">#<?php echo 'col-'.$row["id"].'-1';?></div><div class="editcolcss"><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'col-'.$row["id"].'-1';?>&modal=true&TB_iframe=1&width=640&height=380">Column CSS</a></div></th>
			</tr>
			<tr>
				<td><?php ultimate_wp_list_widget_controls('sidebar-'.$row["id"].'-1');?></td>
			</tr>
			</table>
		</td>
		<td width="25%">
			<table class="widefat">
			<tr>
				<th><div class="colinfo">#<?php echo 'col-'.$row["id"].'-2';?></div><div class="editcolcss"><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'col-'.$row["id"].'-2';?>&modal=true&TB_iframe=1&width=640&height=380">Column CSS</a></div></th>
			</tr>
			<tr>
				<td><?php ultimate_wp_list_widget_controls('sidebar-'.$row["id"].'-2');?></td>
			</tr>
			</table>
		</td>
	</tr>	
</table>
</td>
<td width="25">
<table class="editrows"><tr valign="top"><td><p><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'wrapper-'.$row["id"];?>&modal=true&TB_iframe=1&width=640&height=380">Wrapper CSS</a></p>
<p><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'container-'.$row["id"];?>&modal=true&TB_iframe=1&width=640&height=380">Container CSS</a></p></td></tr><tr valign="bottom"><td><div class="button-secondary delete-item">Delete</div></td></tr></table>
</td>
</tr>
</table>
<?php break; ?>
<?php case '10':?>
<table width="100%" cellpadding="0" cellspacing="5" style="background:#E0E0E0;border-radius:10px;">
<tr valign="top">
<td style="width:22px;">
<div class="drag"></div></td><td><table class="admin_preview" width="100%">
<tr valign="top">
		<td width="33%">
			<table class="widefat">
			<tr>
				<th><div class="colinfo">#<?php echo 'col-'.$row["id"].'-1';?></div><div class="editcolcss"><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'col-'.$row["id"].'-1';?>&modal=true&TB_iframe=1&width=640&height=380">Column CSS</a></div></th>
			</tr>
			<tr>
				<td><?php ultimate_wp_list_widget_controls('sidebar-'.$row["id"].'-1');?></td>
			</tr>
			</table>
		</td>
		<td width="66%">
			<table class="widefat">
			<tr>
				<th><div class="colinfo">#<?php echo 'col-'.$row["id"].'-2';?></div><div class="editcolcss"><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'col-'.$row["id"].'-2';?>&modal=true&TB_iframe=1&width=640&height=380">Column CSS</a></div></th>
			</tr>
			<tr>
				<td><?php ultimate_wp_list_widget_controls('sidebar-'.$row["id"].'-2');?></td>
			</tr>
			</table>
		</td>
	</tr>	
</table>
</td>
<td width="25">
<table class="editrows"><tr valign="top"><td><p><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'wrapper-'.$row["id"];?>&modal=true&TB_iframe=1&width=640&height=380">Wrapper CSS</a></p>
<p><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'container-'.$row["id"];?>&modal=true&TB_iframe=1&width=640&height=380">Container CSS</a></p></td></tr><tr valign="bottom"><td><div class="button-secondary delete-item">Delete</div></td></tr></table>
</td>
</tr>
</table>
<?php break; ?>
<?php case '11':?>
<table width="100%" cellpadding="0" cellspacing="5" style="background:#E0E0E0;border-radius:10px;">
<tr valign="top">
<td style="width:22px;">
<div class="drag"></div></td><td><table class="admin_preview" width="100%">
<tr valign="top">
		<td width="66%">
			<table class="widefat">
			<tr>
				<th><div class="colinfo">#<?php echo 'col-'.$row["id"].'-1';?></div><div class="editcolcss"><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'col-'.$row["id"].'-1';?>&modal=true&TB_iframe=1&width=640&height=380">Column CSS</a></div></th>
			</tr>
			<tr>
				<td><?php ultimate_wp_list_widget_controls('sidebar-'.$row["id"].'-1');?></td>
			</tr>
			</table>
		</td>
		<td width="33%">
			<table class="widefat">
			<tr>
				<th><div class="colinfo">#<?php echo 'col-'.$row["id"].'-2';?></div><div class="editcolcss"><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'col-'.$row["id"].'-2';?>&modal=true&TB_iframe=1&width=640&height=380">Column CSS</a></div></th>
			</tr>
			<tr>
				<td><?php ultimate_wp_list_widget_controls('sidebar-'.$row["id"].'-2');?></td>
			</tr>
			</table>
		</td>
	</tr>	
</table>
</td>
<td width="25">
<table class="editrows"><tr valign="top"><td><p><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'wrapper-'.$row["id"];?>&modal=true&TB_iframe=1&width=640&height=380">Wrapper CSS</a></p>
<p><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'container-'.$row["id"];?>&modal=true&TB_iframe=1&width=640&height=380">Container CSS</a></p></td></tr><tr valign="bottom"><td><div class="button-secondary delete-item">Delete</div></td></tr></table>
</td>
</tr>
</table>
<?php break; ?>
<?php case '12':?>
<table width="100%" cellpadding="0" cellspacing="5" style="background:#E0E0E0;border-radius:10px;">
<tr valign="top">
<td style="width:22px;">
<div class="drag"></div></td><td><table class="admin_preview" width="100%">
<tr valign="top">
		<td width="25%" rowspan="2">
			<table class="widefat">
			<tr>
				<th><div class="colinfo">#<?php echo 'col-'.$row["id"].'-1';?></div><div class="editcolcss"><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'col-'.$row["id"].'-1';?>&modal=true&TB_iframe=1&width=640&height=380">Column CSS</a></div></th>
			</tr>
			<tr>
				<td><?php ultimate_wp_list_widget_controls('sidebar-'.$row["id"].'-1');?></td>
			</tr>
			</table>
		</td>
		<td width="25%">
			<table class="widefat">
			<tr>
				<th><div class="colinfo">#<?php echo 'col-'.$row["id"].'-2';?></div><div class="editcolcss"><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'col-'.$row["id"].'-2';?>&modal=true&TB_iframe=1&width=640&height=380">Column CSS</a></div></th>
			</tr>
			<tr>
				<td><?php ultimate_wp_list_widget_controls('sidebar-'.$row["id"].'-2');?></td>
			</tr>
			</table>
		</td>
		<td width="25%">
			<table class="widefat">
			<tr>
				<th><div class="colinfo">#<?php echo 'col-'.$row["id"].'-3';?></div><div class="editcolcss"><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'col-'.$row["id"].'-3';?>&modal=true&TB_iframe=1&width=640&height=380">Column CSS</a></div></th>
			</tr>
			<tr>
				<td><?php ultimate_wp_list_widget_controls('sidebar-'.$row["id"].'-3');?></td>
			</tr>
			</table>
		</td>
		<td width="25%">
			<table class="widefat">
			<tr>
				<th><div class="colinfo">#<?php echo 'col-'.$row["id"].'-4';?></div><div class="editcolcss"><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'col-'.$row["id"].'-4';?>&modal=true&TB_iframe=1&width=640&height=380">Column CSS</a></div></th>
			</tr>
			<tr>
				<td><?php ultimate_wp_list_widget_controls('sidebar-'.$row["id"].'-4');?></td>
			</tr>
			</table>
		</td>
	</tr>	
	<tr>
		<td width="75%" colspan="3">
			<table class="widefat">
			<tr>
				<th><div class="colinfo">#<?php echo 'col-'.$row["id"].'-5';?></div><div class="editcolcss"><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'col-'.$row["id"].'-5';?>&modal=true&TB_iframe=1&width=640&height=380">Column CSS</a></div></th>
			</tr>
			<tr>
				<td><?php ultimate_wp_list_widget_controls('sidebar-'.$row["id"].'-5');?></td>
			</tr>
			</table>
		</td>
	</tr>
</table>
</td>
<td width="25">
<table class="editrows"><tr valign="top"><td><p><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'wrapper-'.$row["id"];?>&modal=true&TB_iframe=1&width=640&height=380">Wrapper CSS</a></p>
<p><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'container-'.$row["id"];?>&modal=true&TB_iframe=1&width=640&height=380">Container CSS</a></p></td></tr><tr valign="bottom"><td><div class="button-secondary delete-item">Delete</div></td></tr></table>
</td>
</tr>
</table>
<?php break; ?>
<?php case '13':?>
<table width="100%" cellpadding="0" cellspacing="5" style="background:#E0E0E0;border-radius:10px;">
<tr valign="top">
<td style="width:22px;">
<div class="drag"></div></td><td><table class="admin_preview" width="100%">
<tr valign="top">
		<td width="25%">
			<table class="widefat">
			<tr>
				<th><div class="colinfo">#<?php echo 'col-'.$row["id"].'-1';?></div><div class="editcolcss"><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'col-'.$row["id"].'-1';?>&modal=true&TB_iframe=1&width=640&height=380">Column CSS</a></div></th>
			</tr>
			<tr>
				<td><?php ultimate_wp_list_widget_controls('sidebar-'.$row["id"].'-1');?></td>
			</tr>
			</table>
		</td>
		<td width="25%">
			<table class="widefat">
			<tr>
				<th><div class="colinfo">#<?php echo 'col-'.$row["id"].'-2';?></div><div class="editcolcss"><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'col-'.$row["id"].'-2';?>&modal=true&TB_iframe=1&width=640&height=380">Column CSS</a></div></th>
			</tr>
			<tr>
				<td><?php ultimate_wp_list_widget_controls('sidebar-'.$row["id"].'-2');?></td>
			</tr>
			</table>
		</td>
		<td width="25%">
			<table class="widefat">
			<tr>
				<th><div class="colinfo">#<?php echo 'col-'.$row["id"].'-3';?></div><div class="editcolcss"><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'col-'.$row["id"].'-3';?>&modal=true&TB_iframe=1&width=640&height=380">Column CSS</a></div></th>
			</tr>
			<tr>
				<td><?php ultimate_wp_list_widget_controls('sidebar-'.$row["id"].'-3');?></td>
			</tr>
			</table>
		</td>
		<td width="25%" rowspan="2">
			<table class="widefat">
			<tr>
				<th><div class="colinfo">#<?php echo 'col-'.$row["id"].'-4';?></div><div class="editcolcss"><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'col-'.$row["id"].'-4';?>&modal=true&TB_iframe=1&width=640&height=380">Column CSS</a></div></th>
			</tr>
			<tr>
				<td><?php ultimate_wp_list_widget_controls('sidebar-'.$row["id"].'-4');?></td>
			</tr>
			</table>
		</td>
	</tr>	
	<tr>
		<td width="75%" colspan="3">
			<table class="widefat">
			<tr>
				<th><div class="colinfo">#<?php echo 'col-'.$row["id"].'-5';?></div><div class="editcolcss"><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'col-'.$row["id"].'-5';?>&modal=true&TB_iframe=1&width=640&height=380">Column CSS</a></div></th>
			</tr>
			<tr>
				<td><?php ultimate_wp_list_widget_controls('sidebar-'.$row["id"].'-5');?></td>
			</tr>
			</table>
		</td>
	</tr>
</table>
</td>
<td width="25">
<table class="editrows"><tr valign="top"><td><p><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'wrapper-'.$row["id"];?>&modal=true&TB_iframe=1&width=640&height=380">Wrapper CSS</a></p>
<p><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'container-'.$row["id"];?>&modal=true&TB_iframe=1&width=640&height=380">Container CSS</a></p></td></tr><tr valign="bottom"><td><div class="button-secondary delete-item">Delete</div></td></tr></table>
</td>
</tr>
</table>
<?php break; ?>
<?php case '14':?>
<table width="100%" cellpadding="0" cellspacing="5" style="background:#E0E0E0;border-radius:10px;">
<tr valign="top">
<td style="width:22px;">
<div class="drag"></div></td><td><table class="admin_preview" width="100%">
<tr valign="top">
		<td width="25%" rowspan="2">
			<table class="widefat">
			<tr>
				<th><div class="colinfo">#<?php echo 'col-'.$row["id"].'-1';?></div><div class="editcolcss"><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'col-'.$row["id"].'-1';?>&modal=true&TB_iframe=1&width=640&height=380">Column CSS</a></div></th>
			</tr>
			<tr>
				<td><?php ultimate_wp_list_widget_controls('sidebar-'.$row["id"].'-1');?></td>
			</tr>
			</table>
		</td>
		<td width="25%" rowspan="2">
			<table class="widefat">
			<tr>
				<th><div class="colinfo">#<?php echo 'col-'.$row["id"].'-2';?></div><div class="editcolcss"><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'col-'.$row["id"].'-2';?>&modal=true&TB_iframe=1&width=640&height=380">Column CSS</a></div></th>
			</tr>
			<tr>
				<td><?php ultimate_wp_list_widget_controls('sidebar-'.$row["id"].'-2');?></td>
			</tr>
			</table>
		</td>
		<td width="25%">
			<table class="widefat">
			<tr>
				<th><div class="colinfo">#<?php echo 'col-'.$row["id"].'-3';?></div><div class="editcolcss"><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'col-'.$row["id"].'-3';?>&modal=true&TB_iframe=1&width=640&height=380">Column CSS</a></div></th>
			</tr>
			<tr>
				<td><?php ultimate_wp_list_widget_controls('sidebar-'.$row["id"].'-3');?></td>
			</tr>
			</table>
		</td>
		<td width="25%">
			<table class="widefat">
			<tr>
				<th><div class="colinfo">#<?php echo 'col-'.$row["id"].'-4';?></div><div class="editcolcss"><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'col-'.$row["id"].'-4';?>&modal=true&TB_iframe=1&width=640&height=380">Column CSS</a></div></th>
			</tr>
			<tr>
				<td><?php ultimate_wp_list_widget_controls('sidebar-'.$row["id"].'-4');?></td>
			</tr>
			</table>
		</td>
	</tr>	
	<tr>
		<td width="50%" colspan="2">
			<table class="widefat">
			<tr>
				<th><div class="colinfo">#<?php echo 'col-'.$row["id"].'-5';?></div><div class="editcolcss"><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'col-'.$row["id"].'-5';?>&modal=true&TB_iframe=1&width=640&height=380">Column CSS</a></div></th>
			</tr>
			<tr>
				<td><?php ultimate_wp_list_widget_controls('sidebar-'.$row["id"].'-5');?></td>
			</tr>
			</table>
		</td>
	</tr>
</table>
</td>
<td width="25">
<table class="editrows"><tr valign="top"><td><p><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'wrapper-'.$row["id"];?>&modal=true&TB_iframe=1&width=640&height=380">Wrapper CSS</a></p>
<p><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'container-'.$row["id"];?>&modal=true&TB_iframe=1&width=640&height=380">Container CSS</a></p></td></tr><tr valign="bottom"><td><div class="button-secondary delete-item">Delete</div></td></tr></table>
</td>
</tr>
</table>
<?php break; ?>
<?php case '15':?>
<table width="100%" cellpadding="0" cellspacing="5" style="background:#E0E0E0;border-radius:10px;">
<tr valign="top">
<td style="width:22px;">
<div class="drag"></div></td><td><table class="admin_preview" width="100%">
<tr valign="top">
		<td width="25%">
			<table class="widefat">
			<tr>
				<th><div class="colinfo">#<?php echo 'col-'.$row["id"].'-1';?></div><div class="editcolcss"><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'col-'.$row["id"].'-1';?>&modal=true&TB_iframe=1&width=640&height=380">Column CSS</a></div></th>
			</tr>
			<tr>
				<td><?php ultimate_wp_list_widget_controls('sidebar-'.$row["id"].'-1');?></td>
			</tr>
			</table>
		</td>
		<td width="25%">
			<table class="widefat">
			<tr>
				<th><div class="colinfo">#<?php echo 'col-'.$row["id"].'-2';?></div><div class="editcolcss"><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'col-'.$row["id"].'-2';?>&modal=true&TB_iframe=1&width=640&height=380">Column CSS</a></div></th>
			</tr>
			<tr>
				<td><?php ultimate_wp_list_widget_controls('sidebar-'.$row["id"].'-2');?></td>
			</tr>
			</table>
		</td>
		<td width="25%" rowspan="2">
			<table class="widefat">
			<tr>
				<th><div class="colinfo">#<?php echo 'col-'.$row["id"].'-3';?></div><div class="editcolcss"><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'col-'.$row["id"].'-3';?>&modal=true&TB_iframe=1&width=640&height=380">Column CSS</a></div></th>
			</tr>
			<tr>
				<td><?php ultimate_wp_list_widget_controls('sidebar-'.$row["id"].'-3');?></td>
			</tr>
			</table>
		</td>
		<td width="25%" rowspan="2">
			<table class="widefat">
			<tr>
				<th><div class="colinfo">#<?php echo 'col-'.$row["id"].'-4';?></div><div class="editcolcss"><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'col-'.$row["id"].'-4';?>&modal=true&TB_iframe=1&width=640&height=380">Column CSS</a></div></th>
			</tr>
			<tr>
				<td><?php ultimate_wp_list_widget_controls('sidebar-'.$row["id"].'-4');?></td>
			</tr>
			</table>
		</td>
	</tr>	
	<tr>
		<td width="50%" colspan="2">
			<table class="widefat">
			<tr>
				<th><div class="colinfo">#<?php echo 'col-'.$row["id"].'-5';?></div><div class="editcolcss"><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'col-'.$row["id"].'-5';?>&modal=true&TB_iframe=1&width=640&height=380">Column CSS</a></div></th>
			</tr>
			<tr>
				<td><?php ultimate_wp_list_widget_controls('sidebar-'.$row["id"].'-5');?></td>
			</tr>
			</table>
		</td>
	</tr>
</table>
</td>
<td width="25">
<table class="editrows"><tr valign="top"><td><p><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'wrapper-'.$row["id"];?>&modal=true&TB_iframe=1&width=640&height=380">Wrapper CSS</a></p>
<p><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'container-'.$row["id"];?>&modal=true&TB_iframe=1&width=640&height=380">Container CSS</a></p></td></tr><tr valign="bottom"><td><div class="button-secondary delete-item">Delete</div></td></tr></table>
</td>
</tr>
</table>
<?php break; ?>
<?php case '16':?>
<table width="100%" cellpadding="0" cellspacing="5" style="background:#E0E0E0;border-radius:10px;">
<tr valign="top">
<td style="width:22px;">
<div class="drag"></div></td><td><table class="admin_preview" width="100%">
<tr valign="top">
		<td width="25%" rowspan="2">
			<table class="widefat">
			<tr>
				<th><div class="colinfo">Width:220px</div><div class="editcolcss"><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'col-'.$row["id"].'-1';?>&modal=true&TB_iframe=1&width=640&height=380">Column CSS</a></div></th>
			</tr>
			<tr>
				<td><?php ultimate_wp_list_widget_controls('sidebar-'.$row["id"].'-1');?></td>
			</tr>
			</table>
		</td>
		<td width="25%">
			<table class="widefat">
			<tr>
				<th><div class="colinfo">Width:220px</div><div class="editcolcss"><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'col-'.$row["id"].'-2';?>&modal=true&TB_iframe=1&width=640&height=380">Column CSS</a></div></th>
			</tr>
			<tr>
				<td><?php ultimate_wp_list_widget_controls('sidebar-'.$row["id"].'-2');?></td>
			</tr>
			</table>
		</td>
		<td width="25%">
			<table class="widefat">
			<tr>
				<th><div class="colinfo">Width:220px</div><div class="editcolcss"><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'col-'.$row["id"].'-3';?>&modal=true&TB_iframe=1&width=640&height=380">Column CSS</a></div></th>
			</tr>
			<tr>
				<td><?php ultimate_wp_list_widget_controls('sidebar-'.$row["id"].'-3');?></td>
			</tr>
			</table>
		</td>
		<td width="25%" rowspan="2">
			<table class="widefat">
			<tr>
				<th><div class="colinfo">Width:220px</div><div class="editcolcss"><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'col-'.$row["id"].'-4';?>&modal=true&TB_iframe=1&width=640&height=380">Column CSS</a></div></th>
			</tr>
			<tr>
				<td><?php ultimate_wp_list_widget_controls('sidebar-'.$row["id"].'-4');?></td>
			</tr>
			</table>
		</td>
	</tr>	
	<tr>
		<td width="50%" colspan="2">
			<table class="widefat">
			<tr>
				<th><div class="colinfo">Width:460px</div><div class="editcolcss"><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'col-'.$row["id"].'-5';?>&modal=true&TB_iframe=1&width=640&height=380">Column CSS</a></div></th>
			</tr>
			<tr>
				<td><?php ultimate_wp_list_widget_controls('sidebar-'.$row["id"].'-5');?></td>
			</tr>
			</table>
		</td>
	</tr>
</table>
</td>
<td width="25">
<table class="editrows"><tr valign="top"><td><p><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'wrapper-'.$row["id"];?>&modal=true&TB_iframe=1&width=640&height=380">Wrapper CSS</a></p>
<p><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'container-'.$row["id"];?>&modal=true&TB_iframe=1&width=640&height=380">Container CSS</a></p></td></tr><tr valign="bottom"><td><div class="button-secondary delete-item">Delete</div></td></tr></table>
</td>
</tr>
</table>
<?php break; ?>
<?php case '17':?>
<table width="100%" cellpadding="0" cellspacing="5" style="background:#E0E0E0;border-radius:10px;">
<tr valign="top">
<td style="width:22px;">
<div class="drag"></div></td><td><table class="admin_preview" width="100%">
<tr valign="top">
		<td width="25%" rowspan="2">
			<table class="widefat">
			<tr>
				<th><div class="colinfo">#<?php echo 'col-'.$row["id"].'-1';?></div><div class="editcolcss"><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'col-'.$row["id"].'-1';?>&modal=true&TB_iframe=1&width=640&height=380">Column CSS</a></div></th>
			</tr>
			<tr>
				<td><?php ultimate_wp_list_widget_controls('sidebar-'.$row["id"].'-1');?></td>
			</tr>
			</table>
		</td>
		<td width="50%">
			<table class="widefat">
			<tr>
				<th><div class="colinfo">#<?php echo 'col-'.$row["id"].'-2';?></div><div class="editcolcss"><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'col-'.$row["id"].'-2';?>&modal=true&TB_iframe=1&width=640&height=380">Column CSS</a></div></th>
			</tr>
			<tr>
				<td><?php ultimate_wp_list_widget_controls('sidebar-'.$row["id"].'-2');?></td>
			</tr>
			</table>
		</td>
		<td width="25%">
			<table class="widefat">
			<tr>
				<th><div class="colinfo">#<?php echo 'col-'.$row["id"].'-3';?></div><div class="editcolcss"><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'col-'.$row["id"].'-3';?>&modal=true&TB_iframe=1&width=640&height=380">Column CSS</a></div></th>
			</tr>
			<tr>
				<td><?php ultimate_wp_list_widget_controls('sidebar-'.$row["id"].'-3');?></td>
			</tr>
			</table>
		</td>
	</tr>	
	<tr>
		<td width="75%" colspan="2">
			<table class="widefat">
			<tr>
				<th><div class="colinfo">#<?php echo 'col-'.$row["id"].'-4';?></div><div class="editcolcss"><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'col-'.$row["id"].'-4';?>&modal=true&TB_iframe=1&width=640&height=380">Column CSS</a></div></th>
			</tr>
			<tr>
				<td><?php ultimate_wp_list_widget_controls('sidebar-'.$row["id"].'-4');?></td>
			</tr>
			</table>
		</td>
	</tr>
</table>
</td>
<td width="25">
<table class="editrows"><tr valign="top"><td><p><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'wrapper-'.$row["id"];?>&modal=true&TB_iframe=1&width=640&height=380">Wrapper CSS</a></p>
<p><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'container-'.$row["id"];?>&modal=true&TB_iframe=1&width=640&height=380">Container CSS</a></p></td></tr><tr valign="bottom"><td><div class="button-secondary delete-item">Delete</div></td></tr></table>
</td>
</tr>
</table>
<?php break; ?>
<?php case '18':?>
<table width="100%" cellpadding="0" cellspacing="5" style="background:#E0E0E0;border-radius:10px;">
<tr valign="top">
<td style="width:22px;">
<div class="drag"></div></td><td><table class="admin_preview" width="100%">
<tr valign="top">
		<td width="25%" rowspan="2">
			<table class="widefat">
			<tr>
				<th><div class="colinfo">#<?php echo 'col-'.$row["id"].'-1';?></div><div class="editcolcss"><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'col-'.$row["id"].'-1';?>&modal=true&TB_iframe=1&width=640&height=380">Column CSS</a></div></th>
			</tr>
			<tr>
				<td><?php ultimate_wp_list_widget_controls('sidebar-'.$row["id"].'-1');?></td>
			</tr>
			</table>
		</td>
		<td width="25%">
			<table class="widefat">
			<tr>
				<th><div class="colinfo">#<?php echo 'col-'.$row["id"].'-2';?></div><div class="editcolcss"><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'col-'.$row["id"].'-2';?>&modal=true&TB_iframe=1&width=640&height=380">Column CSS</a></div></th>
			</tr>
			<tr>
				<td><?php ultimate_wp_list_widget_controls('sidebar-'.$row["id"].'-2');?></td>
			</tr>
			</table>
		</td>
		<td width="50%">
			<table class="widefat">
			<tr>
				<th><div class="colinfo">#<?php echo 'col-'.$row["id"].'-3';?></div><div class="editcolcss"><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'col-'.$row["id"].'-3';?>&modal=true&TB_iframe=1&width=640&height=380">Column CSS</a></div></th>
			</tr>
			<tr>
				<td><?php ultimate_wp_list_widget_controls('sidebar-'.$row["id"].'-3');?></td>
			</tr>
			</table>
		</td>
	</tr>	
	<tr>
		<td width="75%" colspan="2">
			<table class="widefat">
			<tr>
				<th><div class="colinfo">#<?php echo 'col-'.$row["id"].'-4';?></div><div class="editcolcss"><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'col-'.$row["id"].'-4';?>&modal=true&TB_iframe=1&width=640&height=380">Column CSS</a></div></th>
			</tr>
			<tr>
				<td><?php ultimate_wp_list_widget_controls('sidebar-'.$row["id"].'-4');?></td>
			</tr>
			</table>
		</td>
	</tr>
</table>
</td>
<td width="25">
<table class="editrows"><tr valign="top"><td><p><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'wrapper-'.$row["id"];?>&modal=true&TB_iframe=1&width=640&height=380">Wrapper CSS</a></p>
<p><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'container-'.$row["id"];?>&modal=true&TB_iframe=1&width=640&height=380">Container CSS</a></p></td></tr><tr valign="bottom"><td><div class="button-secondary delete-item">Delete</div></td></tr></table>
</td>
</tr>
</table>
<?php break; ?>
<?php case '19':?>
<table width="100%" cellpadding="0" cellspacing="5" style="background:#E0E0E0;border-radius:10px;">
<tr valign="top">
<td style="width:22px;">
<div class="drag"></div></td><td><table class="admin_preview" width="100%">
<tr valign="top">
		<td width="25%">
			<table class="widefat">
			<tr>
				<th><div class="colinfo">#<?php echo 'col-'.$row["id"].'-1';?></div><div class="editcolcss"><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'col-'.$row["id"].'-1';?>&modal=true&TB_iframe=1&width=640&height=380">Column CSS</a></div></th>
			</tr>
			<tr>
				<td><?php ultimate_wp_list_widget_controls('sidebar-'.$row["id"].'-1');?></td>
			</tr>
			</table>
		</td>
		<td width="50%">
			<table class="widefat">
			<tr>
				<th><div class="colinfo">#<?php echo 'col-'.$row["id"].'-2';?></div><div class="editcolcss"><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'col-'.$row["id"].'-2';?>&modal=true&TB_iframe=1&width=640&height=380">Column CSS</a></div></th>
			</tr>
			<tr>
				<td><?php ultimate_wp_list_widget_controls('sidebar-'.$row["id"].'-2');?></td>
			</tr>
			</table>
		</td>
		<td width="25%" rowspan="2">
			<table class="widefat">
			<tr>
				<th><div class="colinfo">#<?php echo 'col-'.$row["id"].'-3';?></div><div class="editcolcss"><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'col-'.$row["id"].'-3';?>&modal=true&TB_iframe=1&width=640&height=380">Column CSS</a></div></th>
			</tr>
			<tr>
				<td><?php ultimate_wp_list_widget_controls('sidebar-'.$row["id"].'-3');?></td>
			</tr>
			</table>
		</td>
	</tr>	
	<tr>
		<td width="75%" colspan="2">
			<table class="widefat">
			<tr>
				<th><div class="colinfo">#<?php echo 'col-'.$row["id"].'-4';?></div><div class="editcolcss"><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'col-'.$row["id"].'-4';?>&modal=true&TB_iframe=1&width=640&height=380">Column CSS</a></div></th>
			</tr>
			<tr>
				<td><?php ultimate_wp_list_widget_controls('sidebar-'.$row["id"].'-4');?></td>
			</tr>
			</table>
		</td>
	</tr>
</table>
</td>
<td width="25">
<table class="editrows"><tr valign="top"><td><p><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'wrapper-'.$row["id"];?>&modal=true&TB_iframe=1&width=640&height=380">Wrapper CSS</a></p>
<p><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'container-'.$row["id"];?>&modal=true&TB_iframe=1&width=640&height=380">Container CSS</a></p></td></tr><tr valign="bottom"><td><div class="button-secondary delete-item">Delete</div></td></tr></table>
</td>
</tr>
</table>
<?php break; ?>
<?php case '20':?>
<table width="100%" cellpadding="0" cellspacing="5" style="background:#E0E0E0;border-radius:10px;">
<tr valign="top">
<td style="width:22px;">
<div class="drag"></div></td><td><table class="admin_preview" width="100%">
<tr valign="top">
		<td width="50%">
			<table class="widefat">
			<tr>
				<th><div class="colinfo">#<?php echo 'col-'.$row["id"].'-1';?></div><div class="editcolcss"><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'col-'.$row["id"].'-1';?>&modal=true&TB_iframe=1&width=640&height=380">Column CSS</a></div></th>
			</tr>
			<tr>
				<td><?php ultimate_wp_list_widget_controls('sidebar-'.$row["id"].'-1');?></td>
			</tr>
			</table>
		</td>
		<td width="25%">
			<table class="widefat">
			<tr>
				<th><div class="colinfo">#<?php echo 'col-'.$row["id"].'-2';?></div><div class="editcolcss"><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'col-'.$row["id"].'-2';?>&modal=true&TB_iframe=1&width=640&height=380">Column CSS</a></div></th>
			</tr>
			<tr>
				<td><?php ultimate_wp_list_widget_controls('sidebar-'.$row["id"].'-2');?></td>
			</tr>
			</table>
		</td>
		<td width="25%" rowspan="2">
			<table class="widefat">
			<tr>
				<th><div class="colinfo">#<?php echo 'col-'.$row["id"].'-3';?></div><div class="editcolcss"><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'col-'.$row["id"].'-3';?>&modal=true&TB_iframe=1&width=640&height=380">Column CSS</a></div></th>
			</tr>
			<tr>
				<td><?php ultimate_wp_list_widget_controls('sidebar-'.$row["id"].'-3');?></td>
			</tr>
			</table>
		</td>
	</tr>	
	<tr>
		<td width="75%" colspan="2">
			<table class="widefat">
			<tr>
				<th><div class="colinfo">#<?php echo 'col-'.$row["id"].'-4';?></div><div class="editcolcss"><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'col-'.$row["id"].'-4';?>&modal=true&TB_iframe=1&width=640&height=380">Column CSS</a></div></th>
			</tr>
			<tr>
				<td><?php ultimate_wp_list_widget_controls('sidebar-'.$row["id"].'-4');?></td>
			</tr>
			</table>
		</td>
	</tr>
</table>
</td>
<td width="25">
<table class="editrows"><tr valign="top"><td><p><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'wrapper-'.$row["id"];?>&modal=true&TB_iframe=1&width=640&height=380">Wrapper CSS</a></p>
<p><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'container-'.$row["id"];?>&modal=true&TB_iframe=1&width=640&height=380">Container CSS</a></p></td></tr><tr valign="bottom"><td><div class="button-secondary delete-item">Delete</div></td></tr></table>
</td>
</tr>
</table>
<?php break; ?>
<?php case '21':?>
<table width="100%" cellpadding="0" cellspacing="5" style="background:#E0E0E0;border-radius:10px;">
<tr valign="top">
<td style="width:22px;">
<div class="drag"></div></td><td><table class="admin_preview" width="100%">
<tr valign="top">
		<td width="50%" rowspan="2">
			<table class="widefat">
			<tr>
				<th><div class="colinfo">#<?php echo 'col-'.$row["id"].'-1';?></div><div class="editcolcss"><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'col-'.$row["id"].'-1';?>&modal=true&TB_iframe=1&width=640&height=380">Column CSS</a></div></th>
			</tr>
			<tr>
				<td><?php ultimate_wp_list_widget_controls('sidebar-'.$row["id"].'-1');?></td>
			</tr>
			</table>
		</td>
		<td width="25%">
			<table class="widefat">
			<tr>
				<th><div class="colinfo">#<?php echo 'col-'.$row["id"].'-3';?></div><div class="editcolcss"><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'col-'.$row["id"].'-2';?>&modal=true&TB_iframe=1&width=640&height=380">Column CSS</a></div></th>
			</tr>
			<tr>
				<td><?php ultimate_wp_list_widget_controls('sidebar-'.$row["id"].'-2');?></td>
			</tr>
			</table>
		</td>
		<td width="25%">
			<table class="widefat">
			<tr>
				<th><div class="colinfo">#<?php echo 'col-'.$row["id"].'-3';?></div><div class="editcolcss"><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'col-'.$row["id"].'-3';?>&modal=true&TB_iframe=1&width=640&height=380">Column CSS</a></div></th>
			</tr>
			<tr>
				<td><?php ultimate_wp_list_widget_controls('sidebar-'.$row["id"].'-3');?></td>
			</tr>
			</table>
		</td>
	</tr>	
	<tr>
		<td width="50%" colspan="2">
			<table class="widefat">
			<tr>
				<th><div class="colinfo">#<?php echo 'col-'.$row["id"].'-4';?></div><div class="editcolcss"><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'col-'.$row["id"].'-4';?>&modal=true&TB_iframe=1&width=640&height=380">Column CSS</a></div></th>
			</tr>
			<tr>
				<td><?php ultimate_wp_list_widget_controls('sidebar-'.$row["id"].'-4');?></td>
			</tr>
			</table>
		</td>
	</tr>
</table>
</td>
<td width="25">
<table class="editrows"><tr valign="top"><td><p><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'wrapper-'.$row["id"];?>&modal=true&TB_iframe=1&width=640&height=380">Wrapper CSS</a></p>
<p><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'container-'.$row["id"];?>&modal=true&TB_iframe=1&width=640&height=380">Container CSS</a></p></td></tr><tr valign="bottom"><td><div class="button-secondary delete-item">Delete</div></td></tr></table>
</td>
</tr>
</table>
<?php break; ?>
<?php case '22':?>
<table width="100%" cellpadding="0" cellspacing="5" style="background:#E0E0E0;border-radius:10px;">
<tr valign="top">
<td style="width:22px;">
<div class="drag"></div></td><td><table class="admin_preview" width="100%">
<tr valign="top">
		<td width="25%">
			<table class="widefat">
			<tr>
				<th><div class="colinfo">#<?php echo 'col-'.$row["id"].'-1';?></div><div class="editcolcss"><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'col-'.$row["id"].'-1';?>&modal=true&TB_iframe=1&width=640&height=380">Column CSS</a></div></th>
			</tr>
			<tr>
				<td><?php ultimate_wp_list_widget_controls('sidebar-'.$row["id"].'-1');?></td>
			</tr>
			</table>
		</td>
		<td width="25%">
			<table class="widefat">
			<tr>
				<th><div class="colinfo">#<?php echo 'col-'.$row["id"].'-2';?></div><div class="editcolcss"><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'col-'.$row["id"].'-2';?>&modal=true&TB_iframe=1&width=640&height=380">Column CSS</a></div></th>
			</tr>
			<tr>
				<td><?php ultimate_wp_list_widget_controls('sidebar-'.$row["id"].'-2');?></td>
			</tr>
			</table>
		</td>
		<td width="50%" rowspan="2">
			<table class="widefat">
			<tr>
				<th><div class="colinfo">#<?php echo 'col-'.$row["id"].'-3';?></div><div class="editcolcss"><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'col-'.$row["id"].'-3';?>&modal=true&TB_iframe=1&width=640&height=380">Column CSS</a></div></th>
			</tr>
			<tr>
				<td><?php ultimate_wp_list_widget_controls('sidebar-'.$row["id"].'-3');?></td>
			</tr>
			</table>
		</td>
	</tr>	
	<tr>
		<td width="50%" colspan="2">
			<table class="widefat">
			<tr>
				<th><div class="colinfo">#<?php echo 'col-'.$row["id"].'-4';?></div><div class="editcolcss"><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'col-'.$row["id"].'-4';?>&modal=true&TB_iframe=1&width=640&height=380">Column CSS</a></div></th>
			</tr>
			<tr>
				<td><?php ultimate_wp_list_widget_controls('sidebar-'.$row["id"].'-4');?></td>
			</tr>
			</table>
		</td>
	</tr>
</table>
</td>
<td width="25">
<table class="editrows"><tr valign="top"><td><p><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'wrapper-'.$row["id"];?>&modal=true&TB_iframe=1&width=640&height=380">Wrapper CSS</a></p>
<p><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'container-'.$row["id"];?>&modal=true&TB_iframe=1&width=640&height=380">Container CSS</a></p></td></tr><tr valign="bottom"><td><div class="button-secondary delete-item">Delete</div></td></tr></table>
</td>
</tr>
</table>
<?php break; ?>
<?php case '23':?>
<table width="100%" cellpadding="0" cellspacing="5" style="background:#E0E0E0;border-radius:10px;">
<tr valign="top">
<td style="width:22px;">
<div class="drag"></div></td><td><table class="admin_preview" width="100%">
<tr valign="top">
		<td width="33%" rowspan="2">
			<table class="widefat">
			<tr>
				<th><div class="colinfo">#<?php echo 'col-'.$row["id"].'-1';?></div><div class="editcolcss"><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'col-'.$row["id"].'-1';?>&modal=true&TB_iframe=1&width=640&height=380">Column CSS</a></div></th>
			</tr>
			<tr>
				<td><?php ultimate_wp_list_widget_controls('sidebar-'.$row["id"].'-1');?></td>
			</tr>
			</table>
		</td>
		<td width="33%">
			<table class="widefat">
			<tr>
				<th><div class="colinfo">#<?php echo 'col-'.$row["id"].'-2';?></div><div class="editcolcss"><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'col-'.$row["id"].'-2';?>&modal=true&TB_iframe=1&width=640&height=380">Column CSS</a></div></th>
			</tr>
			<tr>
				<td><?php ultimate_wp_list_widget_controls('sidebar-'.$row["id"].'-2');?></td>
			</tr>
			</table>
		</td>
		<td width="33%">
			<table class="widefat">
			<tr>
				<th><div class="colinfo">#<?php echo 'col-'.$row["id"].'-3';?></div><div class="editcolcss"><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'col-'.$row["id"].'-3';?>&modal=true&TB_iframe=1&width=640&height=380">Column CSS</a></div></th>
			</tr>
			<tr>
				<td><?php ultimate_wp_list_widget_controls('sidebar-'.$row["id"].'-3');?></td>
			</tr>
			</table>
		</td>
	</tr>	
	<tr>
		<td width="66%" colspan="2">
			<table class="widefat">
			<tr>
				<th><div class="colinfo">#<?php echo 'col-'.$row["id"].'-4';?></div><div class="editcolcss"><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'col-'.$row["id"].'-4';?>&modal=true&TB_iframe=1&width=640&height=380">Column CSS</a></div></th>
			</tr>
			<tr>
				<td><?php ultimate_wp_list_widget_controls('sidebar-'.$row["id"].'-4');?></td>
			</tr>
			</table>
		</td>
	</tr>
</table>
</td>
<td width="25">
<table class="editrows"><tr valign="top"><td><p><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'wrapper-'.$row["id"];?>&modal=true&TB_iframe=1&width=640&height=380">Wrapper CSS</a></p>
<p><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'container-'.$row["id"];?>&modal=true&TB_iframe=1&width=640&height=380">Container CSS</a></p></td></tr><tr valign="bottom"><td><div class="button-secondary delete-item">Delete</div></td></tr></table>
</td>
</tr>
</table>
<?php break; ?>
<?php case '24':?>
<table width="100%" cellpadding="0" cellspacing="5" style="background:#E0E0E0;border-radius:10px;">
<tr valign="top">
<td style="width:22px;">
<div class="drag"></div></td><td><table class="admin_preview" width="100%">
<tr valign="top">
		<td width="33%">
			<table class="widefat">
			<tr>
				<th><div class="colinfo">#<?php echo 'col-'.$row["id"].'-1';?></div><div class="editcolcss"><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'col-'.$row["id"].'-1';?>&modal=true&TB_iframe=1&width=640&height=380">Column CSS</a></div></th>
			</tr>
			<tr>
				<td><?php ultimate_wp_list_widget_controls('sidebar-'.$row["id"].'-1');?></td>
			</tr>
			</table>
		</td>
		<td width="33%">
			<table class="widefat">
			<tr>
				<th><div class="colinfo">#<?php echo 'col-'.$row["id"].'-2';?></div><div class="editcolcss"><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'col-'.$row["id"].'-2';?>&modal=true&TB_iframe=1&width=640&height=380">Column CSS</a></div></th>
			</tr>
			<tr>
				<td><?php ultimate_wp_list_widget_controls('sidebar-'.$row["id"].'-2');?></td>
			</tr>
			</table>
		</td>
		<td width="33%" rowspan="2">
			<table class="widefat">
			<tr>
				<th><div class="colinfo">#<?php echo 'col-'.$row["id"].'-3';?></div><div class="editcolcss"><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'col-'.$row["id"].'-3';?>&modal=true&TB_iframe=1&width=640&height=380">Column CSS</a></div></th>
			</tr>
			<tr>
				<td><?php ultimate_wp_list_widget_controls('sidebar-'.$row["id"].'-3');?></td>
			</tr>
			</table>
		</td>
	</tr>	
	<tr>
		<td width="66%" colspan="2">
			<table class="widefat">
			<tr>
				<th><div class="colinfo">#<?php echo 'col-'.$row["id"].'-4';?></div><div class="editcolcss"><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'col-'.$row["id"].'-4';?>&modal=true&TB_iframe=1&width=640&height=380">Column CSS</a></div></th>
			</tr>
			<tr>
				<td><?php ultimate_wp_list_widget_controls('sidebar-'.$row["id"].'-4');?></td>
			</tr>
			</table>
		</td>
	</tr>
</table>
</td>
<td width="25">
<table class="editrows"><tr valign="top"><td><p><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'wrapper-'.$row["id"];?>&modal=true&TB_iframe=1&width=640&height=380">Wrapper CSS</a></p>
<p><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'container-'.$row["id"];?>&modal=true&TB_iframe=1&width=640&height=380">Container CSS</a></p></td></tr><tr valign="bottom"><td><div class="button-secondary delete-item">Delete</div></td></tr></table>
</td>
</tr>
</table>
<?php break; ?>
<?php case '25':?>
<table width="100%" cellpadding="0" cellspacing="5" style="background:#E0E0E0;border-radius:10px;">
<tr valign="top">
<td style="width:22px;">
<div class="drag"></div></td><td><table class="admin_preview" width="100%">
<tr valign="top">
		<td width="50%" rowspan="2">
			<table class="widefat">
			<tr>
				<th><div class="colinfo">#<?php echo 'col-'.$row["id"].'-1';?></div><div class="editcolcss"><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'col-'.$row["id"].'-1';?>&modal=true&TB_iframe=1&width=640&height=380">Column CSS</a></div></th>
			</tr>
			<tr>
				<td><?php ultimate_wp_list_widget_controls('sidebar-'.$row["id"].'-1');?></td>
			</tr>
			</table>
		</td>
		<td width="50%" colspan="2">
			<table class="widefat">
			<tr>
				<th><div class="colinfo">#<?php echo 'col-'.$row["id"].'-4';?></div><div class="editcolcss"><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'col-'.$row["id"].'-4';?>&modal=true&TB_iframe=1&width=640&height=380">Column CSS</a></div></th>
			</tr>
			<tr>
				<td><?php ultimate_wp_list_widget_controls('sidebar-'.$row["id"].'-4');?></td>
			</tr>
			</table>
		</td>
		
	</tr>	
	<tr>
		<td width="25%">
			<table class="widefat">
			<tr>
				<th><div class="colinfo">#<?php echo 'col-'.$row["id"].'-2';?></div><div class="editcolcss"><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'col-'.$row["id"].'-2';?>&modal=true&TB_iframe=1&width=640&height=380">Column CSS</a></div></th>
			</tr>
			<tr>
				<td><?php ultimate_wp_list_widget_controls('sidebar-'.$row["id"].'-2');?></td>
			</tr>
			</table>
		</td>
		<td width="25%">
			<table class="widefat">
			<tr>
				<th><div class="colinfo">#<?php echo 'col-'.$row["id"].'-3';?></div><div class="editcolcss"><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'col-'.$row["id"].'-3';?>&modal=true&TB_iframe=1&width=640&height=380">Column CSS</a></div></th>
			</tr>
			<tr>
				<td><?php ultimate_wp_list_widget_controls('sidebar-'.$row["id"].'-3');?></td>
			</tr>
			</table>
		</td>
	</tr>
</table>
</td>
<td width="26">
<table class="editrows"><tr valign="top"><td><p><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'wrapper-'.$row["id"];?>&modal=true&TB_iframe=1&width=640&height=380">Wrapper CSS</a></p>
<p><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'container-'.$row["id"];?>&modal=true&TB_iframe=1&width=640&height=380">Container CSS</a></p></td></tr><tr valign="bottom"><td><div class="button-secondary delete-item">Delete</div></td></tr></table>
</td>
</tr>
</table>
<?php break; ?>
<?php case '26':?>
<table width="100%" cellpadding="0" cellspacing="5" style="background:#E0E0E0;border-radius:10px;">
<tr valign="top">
<td style="width:22px;">
<div class="drag"></div></td><td><table class="admin_preview" width="100%">
<tr valign="top">

		<td width="50%" colspan="2">
			<table class="widefat">
			<tr>
				<th><div class="colinfo">#<?php echo 'col-'.$row["id"].'-4';?></div><div class="editcolcss"><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'col-'.$row["id"].'-4';?>&modal=true&TB_iframe=1&width=640&height=380">Column CSS</a></div></th>
			</tr>
			<tr>
				<td><?php ultimate_wp_list_widget_controls('sidebar-'.$row["id"].'-4');?></td>
			</tr>
			</table>
		</td>
		<td width="50%" rowspan="2">
			<table class="widefat">
			<tr>
				<th><div class="colinfo">#<?php echo 'col-'.$row["id"].'-3';?></div><div class="editcolcss"><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'col-'.$row["id"].'-3';?>&modal=true&TB_iframe=1&width=640&height=380">Column CSS</a></div></th>
			</tr>
			<tr>
				<td><?php ultimate_wp_list_widget_controls('sidebar-'.$row["id"].'-3');?></td>
			</tr>
			</table>
		</td>
	</tr>	
	<tr>
		<td width="25%">
			<table class="widefat">
			<tr>
				<th><div class="colinfo">#<?php echo 'col-'.$row["id"].'-1';?></div><div class="editcolcss"><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'col-'.$row["id"].'-1';?>&modal=true&TB_iframe=1&width=640&height=380">Column CSS</a></div></th>
			</tr>
			<tr>
				<td><?php ultimate_wp_list_widget_controls('sidebar-'.$row["id"].'-1');?></td>
			</tr>
			</table>
		</td>
		<td width="25%">
			<table class="widefat">
			<tr>
				<th><div class="colinfo">#<?php echo 'col-'.$row["id"].'-2';?></div><div class="editcolcss"><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'col-'.$row["id"].'-2';?>&modal=true&TB_iframe=1&width=640&height=380">Column CSS</a></div></th>
			</tr>
			<tr>
				<td><?php ultimate_wp_list_widget_controls('sidebar-'.$row["id"].'-2');?></td>
			</tr>
			</table>
		</td>
	</tr>
</table>
</td>
<td width="25">
<table class="editrows"><tr valign="top"><td><p><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'wrapper-'.$row["id"];?>&modal=true&TB_iframe=1&width=640&height=380">Wrapper CSS</a></p>
<p><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'container-'.$row["id"];?>&modal=true&TB_iframe=1&width=640&height=380">Container CSS</a></p></td></tr><tr valign="bottom"><td><div class="button-secondary delete-item">Delete</div></td></tr></table>
</td>
</tr>
</table>
<?php break; ?>
<?php case '27':?>
<table width="100%" cellpadding="0" cellspacing="5" style="background:#E0E0E0;border-radius:10px;">
<tr valign="top">
<td style="width:22px;">
<div class="drag"></div></td><td><table class="admin_preview" width="100%">
<tr valign="top">
		<td width="33%" rowspan="2">
			<table class="widefat">
			<tr>
				<th><div class="colinfo">#<?php echo 'col-'.$row["id"].'-1';?></div><div class="editcolcss"><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'col-'.$row["id"].'-1';?>&modal=true&TB_iframe=1&width=640&height=380">Column CSS</a></div></th>
			</tr>
			<tr>
				<td><?php ultimate_wp_list_widget_controls('sidebar-'.$row["id"].'-1');?></td>
			</tr>
			</table>
		</td>
		<td width="66%" colspan="2">
			<table class="widefat">
			<tr>
				<th><div class="colinfo">#<?php echo 'col-'.$row["id"].'-4';?></div><div class="editcolcss"><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'col-'.$row["id"].'-4';?>&modal=true&TB_iframe=1&width=640&height=380">Column CSS</a></div></th>
			</tr>
			<tr>
				<td><?php ultimate_wp_list_widget_controls('sidebar-'.$row["id"].'-4');?></td>
			</tr>
			</table>
		</td>
	</tr>	
	<tr>
		<td width="33%">
			<table class="widefat">
			<tr>
				<th><div class="colinfo">#<?php echo 'col-'.$row["id"].'-2';?></div><div class="editcolcss"><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'col-'.$row["id"].'-2';?>&modal=true&TB_iframe=1&width=640&height=380">Column CSS</a></div></th>
			</tr>
			<tr>
				<td><?php ultimate_wp_list_widget_controls('sidebar-'.$row["id"].'-2');?></td>
			</tr>
			</table>
		</td>
		<td width="33%">
			<table class="widefat">
			<tr>
				<th><div class="colinfo">#<?php echo 'col-'.$row["id"].'-3';?></div><div class="editcolcss"><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'col-'.$row["id"].'-3';?>&modal=true&TB_iframe=1&width=640&height=380">Column CSS</a></div></th>
			</tr>
			<tr>
				<td><?php ultimate_wp_list_widget_controls('sidebar-'.$row["id"].'-3');?></td>
			</tr>
			</table>
		</td>
		
	</tr>
</table>
</td>
<td width="25">
<table class="editrows"><tr valign="top"><td><p><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'wrapper-'.$row["id"];?>&modal=true&TB_iframe=1&width=640&height=380">Wrapper CSS</a></p>
<p><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'container-'.$row["id"];?>&modal=true&TB_iframe=1&width=640&height=380">Container CSS</a></p></td></tr><tr valign="bottom"><td><div class="button-secondary delete-item">Delete</div></td></tr></table>
</td>
</tr>
</table>
<?php break; ?>
<?php case '28':?>
<table width="100%" cellpadding="0" cellspacing="5" style="background:#E0E0E0;border-radius:10px;">
<tr valign="top">
<td style="width:22px;">
<div class="drag"></div></td><td><table class="admin_preview" width="100%">
<tr valign="top">
		<td width="66%" colspan="2">
			<table class="widefat">
			<tr>
				<th><div class="colinfo">#<?php echo 'col-'.$row["id"].'-4';?></div><div class="editcolcss"><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'col-'.$row["id"].'-4';?>&modal=true&TB_iframe=1&width=640&height=380">Column CSS</a></div></th>
			</tr>
			<tr>
				<td><?php ultimate_wp_list_widget_controls('sidebar-'.$row["id"].'-4');?></td>
			</tr>
			</table>
		</td>
		<td width="33%" rowspan="2">
			<table class="widefat">
			<tr>
				<th><div class="colinfo">#<?php echo 'col-'.$row["id"].'-3';?></div><div class="editcolcss"><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'col-'.$row["id"].'-3';?>&modal=true&TB_iframe=1&width=640&height=380">Column CSS</a></div></th>
			</tr>
			<tr>
				<td><?php ultimate_wp_list_widget_controls('sidebar-'.$row["id"].'-3');?></td>
			</tr>
			</table>
		</td>
	</tr>	
	<tr>
		<td width="33%">
			<table class="widefat">
			<tr>
				<th><div class="colinfo">#<?php echo 'col-'.$row["id"].'-1';?></div><div class="editcolcss"><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'col-'.$row["id"].'-1';?>&modal=true&TB_iframe=1&width=640&height=380">Column CSS</a></div></th>
			</tr>
			<tr>
				<td><?php ultimate_wp_list_widget_controls('sidebar-'.$row["id"].'-1');?></td>
			</tr>
			</table>
		</td>
		<td width="33%">
			<table class="widefat">
			<tr>
				<th><div class="colinfo">#<?php echo 'col-'.$row["id"].'-2';?></div><div class="editcolcss"><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'col-'.$row["id"].'-2';?>&modal=true&TB_iframe=1&width=640&height=380">Column CSS</a></div></th>
			</tr>
			<tr>
				<td><?php ultimate_wp_list_widget_controls('sidebar-'.$row["id"].'-2');?></td>
			</tr>
			</table>
		</td>
		
	</tr>
</table>
</td>
<td width="25">
<table class="editrows"><tr valign="top"><td><p><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'wrapper-'.$row["id"];?>&modal=true&TB_iframe=1&width=640&height=380">Wrapper CSS</a></p>
<p><a class="thickbox button-primary autowidth" href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/css-generator.php?layoutid=<?php echo $_GET["layoutid"];?>&container=<?php echo 'container-'.$row["id"];?>&modal=true&TB_iframe=1&width=640&height=380">Container CSS</a></p></td></tr><tr valign="bottom"><td><div class="button-secondary delete-item">Delete</div></td></tr></table>
</td>
</tr>
</table>
<?php break; ?>
<?php } ?>
</li>
