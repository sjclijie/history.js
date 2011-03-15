<?php
	# Header
	require_once(dirname(__FILE__).'/_header.php');

	# Support
	$support = isset($_GET['support']) ? $_GET['support'] : null;
	if ( !in_array($support,$supports) ) {
		throw new Exception('Unknown support ['.$support.']');
	}

	# Adapter
	$adapter = isset($_GET['adapter']) ? $_GET['adapter'] : null;
	if ( !in_array($adapter,$adapters) ) {
		throw new Exception('Unknown adapter ['.$adapter.']');
	}

	# Dir
	$dir = isset($_GET['dir']) ? $_GET['dir'] : null;
	if ( !in_array($dir,$dirs) ) {
		throw new Exception('Unknown dir ['.$dirs.']');
	}

	# Url
	$tests_full_url = $tests_url."${dir}/${support}/${adapter}/";

	# Titles
	$Support = strtoupper($support);
	$Adapter = ucwords($adapter);
	$Dir = ucwords($dir);
	$title = "History.js ${Dir} ${Support} ${Adapter} Test Suite";
?><!DOCTYPE html>
<html>
<head>
	<title><?=$title?></title>
	<base href="<?=$tests_url?>" />
	<!-- Check -->
	<script type="text/javascript">
		if ( document.location.href !== "<?=$tests_full_url?>" ) {
			document.location.href = "<?=$tests_full_url?>";
		}
	</script>
</head>
<body>
	<!-- FireBug Lite -->
	<script type="text/javascript">
		if ( typeof console === 'undefined' ) {
			var
				url = '../vendor/firebug-lite.js',
				scriptEl = document.createElement('script');
			scriptEl.type = 'text/javascript';
			scriptEl.src = url;
			document.body.appendChild(scriptEl,document.body.firstChild);
		}
	</script>

	<!-- History.js -->
	<script type="text/javascript" defer>
		if ( typeof JSON === 'undefined' ) {
			var
				url = '../scripts/uncompressed/json2.js',
				scriptEl = document.createElement('script');
			scriptEl.type = 'text/javascript';
			scriptEl.src = url;
			document.body.appendChild(scriptEl,document.body.firstChild);
		}
	</script>
	<script type="text/javascript" src="../vendor/<?=$adapter?>.js" defer></script>
	<script type="text/javascript" src="../scripts/<?=$dir?>/history.adapter.<?=$adapter?>.js" defer></script>
	<script type="text/javascript" src="../scripts/<?=$dir?>/history.js" defer></script>
	<?php if ( $support === 'html4' ) : ?>
	<script type="text/javascript" src="../scripts/<?=$dir?>/history.html4.js" defer></script>
	<?php endif; ?>

	<!-- QUnit -->
	<link rel="stylesheet" href="../vendor/qunit/qunit/qunit.css" type="text/css" media="screen">
	<script type="text/javascript" src="../vendor/qunit/qunit/qunit.js" defer></script>

	<!-- Tests -->
	<script type="text/javascript" src="tests.js" defer></script>

	<!-- Elements -->
	<h1 id="qunit-header"><?=$title?></h1>
	<h2 id="qunit-banner"></h2>
	<div id="qunit-testrunner-toolbar"></div>
	<h2 id="qunit-userAgent"></h2>
	<ol id="qunit-tests"></ol>
	<div id="qunit-fixture">test markup</div>
	<div id="log"></div>
</body>
</html>
