<style>
    .comm {
    width: 645px;
    margin: 0 0 0 -42px;
    background: url({THEME}/images/comm.jpg) repeat-y;
}
    .comm1 {
    background: url({THEME}/images/comm1.jpg) no-repeat;
}
    .comm2 {
    background: url({THEME}/images/comm2.jpg) no-repeat bottom left;
    padding: 0 0 50px 0px;
}
    .comm3 {
    position: relative;
    padding: 34px 0 0 41px;
}
</style>
<div class="comm">
	<div class="comm1">
		<div class="comm2">
			<div class="comm3">
				<div class="comm-ava"><img src="{foto}" alt=""></div>
                <div class="comm-user"><b><a onclick="ShowProfile('{login}', '/{login}', '0'); return false;" href="/{login}">{login}</a></b> {data}</div>
				<ul class="reset comm-links">
					<span style="float: right">[complaint]<i class="uk-icon-bell" data-uk-tooltip="" title="Жалоба"></i>[/complaint]	[com-edit]<i class="uk-icon-edit" data-uk-tooltip="" title="Изменить"></i>[/com-edit] [com-del]<i class="uk-icon-close" data-uk-tooltip="" title="Удалить"></i>[/com-del]</span>
				</ul>
				<div class="comm-text">
					{comment}
				</div>
			</div>
		</div>
	</div>
</div>