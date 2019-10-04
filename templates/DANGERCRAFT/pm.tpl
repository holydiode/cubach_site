
<div class='baseform' style="    margin-left: -44px;    width: 567px;    margin-top: 39px;">
       <h3> Личные сообщения</h3>
<style>
    .baseform {
    background: #fdfdfd url(https://streamcraft.net/templates/Streamcraft/images/news_bg.jpg) left top repeat-x;
    padding: 15px;
    border: 1px solid #e8e6e3;
    box-shadow: 0px 2px 5px rgba(0,0,0,0.1);
}
    </style>
<div class="viewn-content" style="    text-decoration: none; padding:0 5px;">

<center><div class="uk-button-group" style="    text-decoration: none; width: 609px; margin-bottom: 15px;     text-decoration: none;">
	<button class="uk-button" type="button" style="width: 173px;margin-left: -52px;"><a href="/index.php?do=pm&amp;folder=inbox"><span style="text-decoration: none; color: black;">Входящие сообщения</span></a></button>
	<button class="uk-button" type="button" style="width: 203px;"><a href="/index.php?do=pm&amp;folder=outbox"><span style="text-decoration: none; color: black;">Отправленные сообщения</span></a></button>
	<button class="uk-button" type="button" style="width: 203px;"><a href="/index.php?do=pm&amp;doaction=newpm"><span style="text-decoration: none; color: black;">Написать сообщение</span></a></button>
</div></center>
    
<div class="basecont">
<div class="dpad"><center>
<div class="pm_status" style="width: 95%;">
<div class="uk-progress uk-progress-success">
			<div class="uk-progress-bar" style="width: {proc-pm-limit}%;"></div>
		</div>
<center style="margin-top: -35px; font-size: 16px;">Ваш почтовый ящик заполнен на {proc-pm-limit}%</center>
    </div></center>
    
</div><br />
<div class="clr"></div>
<br />
[pmlist]
<div class="dpad">{pmlist}</div>
[/pmlist]
[newpm]
<table class="uk-form">
	<tbody>
		<tr>
			<td class="label"><span style="font-size: 16px;">Кому:</span></td>
			<td>
				<input type="text" name="name" value="{author}" style=" width: 462px; height: 30px; font-size: 14pt" placeholder="Example" class="f_input" /></td>
		</tr>
		<tr>
			<td class="label"><span style="font-size: 16px;">Тема:</span></td>
			<td>
				<input type="text" name="subj" value="{subj}" style=" width: 462px; height: 30px; font-size: 14pt" placeholder="GrCraft - классный проект!" class="f_input" /></td>
		</tr>
		<tr>
			<td class="label"><span style="font-size: 16px;">Сообщение:</span></td>
			<td class="editorcomm">{editor}<br />
				
				<div class="checkbox">
					<input type="checkbox" id="outboxcopy" name="outboxcopy" value="1" /> 
					<label for="outboxcopy">Сохранить сообщение в папке "Отправленные"</label></div><br />
				</td>
		</tr>
		<tr>
			<td class="label">Введите капчу:<span class="impot">*</span></td>
			<td>
				<div>{recaptcha}</div></td>
		</tr>
	</tbody>
</table>
<div class="fieldsubmit">
						<div class="uk-grid" style="height: 40px">
							<div class="uk-width-2-3">
								<button type="submit" name="add" class="uk-button uk-button-success uk-width-1-1"><span><i class="uk-icon-ok"></i> Отправить</span></button>
							</div>
							<div class="uk-width-1-3">
								<input type="button" class="uk-button uk-button-primary uk-width-1-1" onclick="dlePMPreview()" title="Просмотр" value="Просмотр">
							</div>
						</div>
					</div>

[/newpm]
[readpm]
<article class="uk-comment">
    <header class="uk-comment-header">
		<h4 class="uk-comment-title">{author}</h4>        
      <div class="uk-comment-meta">Отправлено: {date} | Группа: {group-name}</div>   </header>    
	<div class="uk-comment-body">
  <h3 style="margin-bottom: 0.4em;">Тема: [reply]{subj}[/reply]</h3>Сообщение: {text}
  </div></article>
[/readpm]
</div>
       </div>
   </div>

