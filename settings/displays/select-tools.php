<style>
.wsuwp-toolbox-tools-form th {
	display: none;
}
.wsuwp-toolbox-modules-wrapper {
	display: flex;
	padding-top: 20px;
}

.wsuwp-toolbox-module-card {
	width: 225px;
	border: 1px solid rgba(0,0,0,0.2);
	/*border: 1px solid #a60f2d;*/
	padding: 20px 20px 90px 20px;
	box-sizing: border-box;
	margin: 10px 10px 60px 10px;
	background-color: #fff;
	position: relative;
}

.wsuwp-toolbox-module-card-owner {
	display: block;
	position: absolute;
	left: 0;
	bottom: 100%;
	background-color: rgba(0,0,0,0.5);
	text-transform: uppercase;
	font-size: 12px;
	font-weight: bold;
	letter-spacing: 1px;
	color: #fff;
	padding: 0 12px;
	height: 25px;
	line-height: 25px;
}
.wsuwp-toolbox-module-card-owner:after {
	content: "";
	display: block;
	position: absolute;
	width: 0;
    height: 0;
    border-bottom: 25px solid rgba(0,0,0,0.5);
	border-right: 10px solid transparent;
	top: 0;
	left: 100%;
}

.is-active-module  .wsuwp-toolbox-module-card-owner {
	background-color: #a60f2d;
}

.is-active-module .wsuwp-toolbox-module-card-owner:after {
	border-bottom: 25px solid #a60f2d;
}

.wsuwp-toolbox-module-card-icon {
	display: block;
	height: 160px;
	background-repeat: no-repeat;
	background-size: contain;
	background-position: center center;
}

.wsuwp-toolbox-module-card-title {
	display: block;
	color: #a60f2d;
	font-size: 16px;
	padding: 6px 0;
}

.wsuwp-toolbox-module-card-desc {
	display: block;
}

.wsuwp-toolbox-module-card-activate {
	display: block;
	position: absolute;
	left: 20px;
	right: 20px;
	bottom: 20px;
}
.wsuwp-toolbox-module-card-activate button {
	width: 100%;
	height: 50px;
	text-align: center;
	font-size: 18px;
	letter-spacing: 1px;
	cursor: pointer;
	border: 1px solid rgba(0,0,0,0.5);
	color: #333;
	border-radius: 0;
	background-color: rgba(0,0,0,0.1);
}

.is-active-module .wsuwp-toolbox-module-card-activate button {
	color: #fff;
	background-color: #a60f2d;
	border: 1px solid #a60f2d;
}

.wsuwp-toolbox-module-card-activate button:hover {
	color: #fff;
	background-color: #333;
}
</style>
<div class="wsuwp-toolbox-wrap">
	<h1>WSU Toolbox</h1>
	<form class="wsuwp-toolbox-tools-form" action="options.php" method="post">
	<?php settings_fields( 'wsuwp_toolbox' ); ?>
		<?php do_settings_sections( 'wsuwp_toolbox' ); ?>
		</form>
</div>
