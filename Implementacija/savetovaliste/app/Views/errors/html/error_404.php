<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>404 Stranica nije pronadjena</title>

	<style>
		div.logo {
			height: 200px;
			width: 155px;
			display: inline-block;
			opacity: 0.08;
			position: absolute;
			top: 2rem;
			left: 50%;
			margin-left: -73px;
		}
		body {
			height: 100%;
			background: #0575E6;  /* fallback for old browsers */
			background: -webkit-linear-gradient(to right, rgb(7,73,165), #0575E6);  /* Chrome 10-25, Safari 5.1-6 */
			background: linear-gradient(to right, rgb(7,73,165), #0a63bd); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
			font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
			color: #777;
			font-weight: 300;
		}
		h1 {
			font-weight: lighter;
			letter-spacing: 0.8;
			font-size: 3rem;
			margin-top: 0;
			margin-bottom: 0;
			color: #222;
		}
		.wrap {
			max-width: 1024px;
			margin: 5rem auto;
			padding: 2rem;
			background-color: #63a4ff;
  			background-image: linear-gradient(315deg, #63a4ff 0%, #83eaf1 74%);
			text-align: center;
			border: 1px solid #efefef;
			border-radius: 0.5rem;
			position: relative;
		}
		pre {
			white-space: normal;
			margin-top: 1.5rem;
		}
		code {
			background: #fafafa;
			border: 1px solid #efefef;
			padding: 0.5rem 1rem;
			border-radius: 5px;
			display: block;
		}
		p {
			margin-top: 1.5rem;
		}
		.footer {
			margin-top: 2rem;
			border-top: 1px solid #efefef;
			padding: 1em 2em 0 2em;
			font-size: 85%;
			color: #999;
		}
		a:active,
		a:link,
		a:visited {
			color: #dd4814;
		}
	</style>
</head>
<body>
	<div class="wrap">
		<h1>404 - Fajl nije pronadjen!</h1>

		<p>
			<?php if (! empty($message) && $message !== '(null)') : ?>
				<?= nl2br(esc($message)) ?>
			<?php else : ?>
				Izgleda da ne postoji stranica koju tražite! :(
			<?php endif ?>
		</p>
	</div>
</body>
</html>
