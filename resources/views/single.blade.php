<div class="row">
	<div class="col-md-12 text-center">
		<h2 class="page-header">
			{{ $page_title }}
		</h2>	
		<div class="btn-group" role="group" aria-label="...">
		   <button class="btn btn-primary filter" data-toggle="tooltip" title="All Feeds" data-filter="all">All</button>
		   <button class="btn btn-primary filter" data-toggle="tooltip" title="Facebook" data-filter=".facebook"><i class="fa fa-facebook-official"></i></button>
		   <button class="btn btn-primary filter" data-toggle="tooltip" title="Twitter" data-filter=".twitter"><i class="fa fa-twitter"></i></button>
		   <button class="btn btn-primary filter" data-toggle="tooltip" title="Google Plus" data-filter=".google-plus"><i class="fa fa-google-plus"></i></button>
		   <button class="btn btn-primary filter" data-toggle="tooltip" title="RSS" data-filter=".rss"><i class="fa fa-rss"></i></button>
		   <button class="btn btn-primary filter" data-toggle="tooltip" title="Flickr" data-filter=".flickr"><i class="fa fa-flickr"></i></button>
		   <button class="btn btn-primary filter" data-toggle="tooltip" title="Delicious" data-filter=".delicious"><i class="fa fa-delicious"></i></button>
		   <button class="btn btn-primary filter" data-toggle="tooltip" title="Youtube" data-filter=".youtube"><i class="fa fa-youtube"></i></button>
		   <button class="btn btn-primary filter" data-toggle="tooltip" title="Pinterest" data-filter=".pinterest"><i class="fa fa-pinterest-p"></i></button>
		   <button class="btn btn-primary filter" data-toggle="tooltip" title="Lastfm" data-filter=".lastfm"><i class="fa fa-lastfm"></i></button>
		   <button class="btn btn-primary filter" data-toggle="tooltip" title="Dribbble" data-filter=".dribbble"><i class="fa fa-dribbble"></i></button>
		   <button class="btn btn-primary filter" data-toggle="tooltip" title="Vimeo" data-filter=".vimeo"><i class="fa fa-vimeo"></i></button>
		   <button class="btn btn-primary filter" data-toggle="tooltip" title="Stumbleupon" data-filter=".stumbleupon"><i class="fa fa-stumbleupon"></i></button>
		   <button class="btn btn-primary filter" data-toggle="tooltip" title="Deviantart" data-filter=".deviantart"><i class="fa fa-deviantart"></i></button>
		   <button class="btn btn-primary filter" data-toggle="tooltip" title="Tumblr" data-filter=".tumblr"><i class="fa fa-tumblr"></i></button>
		   <button class="btn btn-primary filter" data-toggle="tooltip" title="Instagram" data-filter=".instagram"><i class="fa fa-instagram"></i></button>
		</div>
	</div>
</div>
<br><br><br>
<div class="row" id="sortable-columns">
	<div class="col-sm-3 mix facebook">
		<div class="nm-facebook">
			<div class="panel panel-default">
			  <div class="panel-body">
			    <div class="thumbnail">
			    	<img src="{{ URL::asset('img/1.jpg') }}" class="img-responsive">
			    </div>
			    <p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
			    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo</p>
			  </div>
			  <div class="panel-footer"><i class="fa fa-facebook"></i> <a href="">twitted </a>1 month ago</div>
			</div>					
		</div>
	</div>
	<div class="col-sm-3 mix twitter">
		<div class="nm-twitter">
			<div class="panel panel-default">
				<div class="panel-body">
					<p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo</p>
				</div>
			  <div class="panel-footer"><i class="fa fa-twitter"></i> <a href="">Posted </a>1 month ago</div>
			</div>					
		</div>
	</div>
	<div class="col-sm-3 mix google-plus">
		<div class="nm-google-plus">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="thumbnail">
			    		<img src="{{ URL::asset('img/1.jpg') }}" class="img-responsive">
			    	</div>
					<p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo</p>
				</div>
			  <div class="panel-footer"><i class="fa fa-google-plus"></i> <a href="">shared </a>1 month ago</div>
			</div>					
		</div>
	</div>
	<div class="col-sm-3 mix youtube">
		<div class="nm-youtube">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="thumbnail">
			    		<img src="{{ URL::asset('img/1.jpg') }}" class="img-responsive">
			    	</div>
					<h6><b>Lorem ipsum dolor sit amet, conseclaboris nisi ut aliquip ex ea commodo</b></h6>
				</div>
			  <div class="panel-footer"><i class="fa fa-youtube"></i> <a href="">Uploaded </a>1 month ago</div>
			</div>					
		</div>
	</div>
	<div class="col-sm-3 mix flickr">
		<div class="nm-flickr">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="thumbnail">
			    		<img src="{{ URL::asset('img/1.jpg') }}" class="img-responsive">
			    	</div>
					<h6>Lorem ipsum dolor sit amet, conseclaboris nisi ut aliquip ex ea commodo</h6>
				</div>
			  <div class="panel-footer"><i class="fa fa-flickr"></i> <a href="">Uploaded </a>1 month ago</div>
			</div>					
		</div>
	</div>
	<div class="col-sm-3 mix pinterest">
		<div class="nm-pinterest">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="thumbnail">
			    		<img src="{{ URL::asset('img/1.jpg') }}" class="img-responsive">
			    	</div>
					<h6>Lorem ipsum</h6>
				</div>
			  <div class="panel-footer"><i class="fa fa-dribbble"></i> <a href="">Pinned </a>1 month ago</div>
			</div>					
		</div>
	</div>
	<div class="col-sm-3 mix rss">
		<div class="nm-rss">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="thumbnail">
			    		<img src="{{ URL::asset('img/1.jpg') }}" class="img-responsive">
			    	</div>
					<h6>Lorem ipsum</h6>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
					consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
					cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
					proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
				</div>
			  <div class="panel-footer"><i class="fa fa-rss"></i> <a href="">Posted </a>1 month ago</div>
			</div>					
		</div>
	</div>
	<div class="col-sm-3 mix lastfm">
		<div class="nm-lastfm">
			<div class="panel panel-default">
				<div class="panel-body">
					<a href="">
						<span class="fa fa-headphones"><b>Lorem ipsum</b></span>
					</a>
				</div>
			  <div class="panel-footer"><i class="fa fa-lastfm"></i> <a href="">lestened to </a>1 month ago</div>
			</div>					
		</div>
	</div>
	<div class="col-sm-3 mix dribbble">
		<div class="nm-dribbble">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="thumbnail">
			    		<img src="{{ URL::asset('img/1.jpg') }}" class="img-responsive">
			    	</div>
			    	<h6>lorem ulser</h6>
				</div>
			  <div class="panel-footer"><i class="fa fa-dribbble"></i> <a href="">Linked </a>1 month ago</div>
			</div>					
		</div>
	</div>
	<div class="col-sm-3 mix vimeo">
		<div class="nm-vimeo">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="thumbnail">
			    		<img src="{{ URL::asset('img/1.jpg') }}" class="img-responsive">
			    	</div>
			    	<a href=""><h6>lorem ulser</h6></a>
			    	<span>320 sec</span>
				</div>
			  <div class="panel-footer"><i class="fa fa-vimeo"></i> <a href="">Linked </a>1 month ago</div>
			</div>					
		</div>
	</div>
	<div class="col-sm-3 mix stumbleupon">
		<div class="nm-stumbleupon">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="thumbnail">
			    		<img src="{{ URL::asset('img/1.jpg') }}" class="img-responsive">
			    	</div>
			    	<a href=""><h6>lorem ulser</h6></a>
			    	<span>32 views</span>
				</div>
			  <div class="panel-footer"><i class="fa fa-stumbleupon"></i> <a href="">Shared </a>1 month ago</div>
			</div>					
		</div>
	</div>
	<div class="col-sm-3 mix instagram">
		<div class="nm-instagram">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="thumbnail">
			    		<img src="{{ URL::asset('img/1.jpg') }}" class="img-responsive">
			    	</div>
				</div>
			  <div class="panel-footer"><i class="fa fa-instagram"></i> <a href="">Posted </a>1 month ago</div>
			</div>					
		</div>
	</div>
</div>


<h1>{{ $page_title }}</h1>
<ul>
<?php foreach ($stream_settings as $id => $network_data) {
	echo '<li><pre>';
	print_r($network_data);
	echo '</li></pre>';
} ?>
</ul>

<div class="contents">
	{!! $page_contents !!}
</div>