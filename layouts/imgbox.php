<?php

//https://api.mashiro.top/cover
function curl_get($url){
	$header = array(
	'Accept: application/json',
	);
	$curl = curl_init();
	//设置抓取的url
	curl_setopt($curl, CURLOPT_URL, $url);
	//设置头文件的信息作为数据流输出
	curl_setopt($curl, CURLOPT_HEADER, 0);
	// 超时设置,以秒为单位
	curl_setopt($curl, CURLOPT_TIMEOUT, 1);
	
	// 超时设置，以毫秒为单位
	// curl_setopt($curl, CURLOPT_TIMEOUT_MS, 500);
	// 设置请求头
	curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
	curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36 Edg/96.0.1054.62");
	//设置获取的信息以文件流的形式返回，而不是直接输出。
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
	//执行命令
	$data = curl_exec($curl);
	
	// 显示错误信息
	if (curl_error($curl)) {
	// print "Error: " . curl_error($curl);
	} else {
	// 打印返回的内容
	// var_dump($data);
	
	curl_close($curl);
	}
	return $data;
}

function get_random_word(){
	// 获取随机一言
	$api_ = [
	 "v1.hitokoto.cn" => [
		 "url" => "https://v1.hitokoto.cn/",
		 "key"=>"hitokoto",
	 ],
	 "api.fghrsh.net" => [
				 "url" => "https://api.fghrsh.net/hitokoto/rand/?encode=jsc&uid=3335",
				 "key" => "hitokoto",
		 ],
		 "v2.jinrishici.com" => [
				 "url" => "https://v2.jinrishici.com/one.json",
				 "key" => "data,content",
		 ]
	];
	$random_api = array_rand($api_);
	$random_api_url = $api_[$random_api]['url'];
	$random_api_key_split = explode(",",$api_[$random_api]['key']);
	$resp = json_decode(curl_get($random_api_url),true);
	$result_word = "";
	foreach($random_api_key_split as $key => $value){
		 $result_word = $resp[$value];
		 $resp = $resp[$value];
	}
	return $result_word;
}
?>
<figure id="centerbg" class="centerbg">
<?php if ( !akina_option('focus_infos') ){ ?>
	<div class="focusinfo">
        <?php if (akina_option('focus_logo_text')):?>
        <h1 class="center-text glitch is-glitching Ubuntu-font" data-text="<?php echo akina_option('focus_logo_text', ''); ?>"><?php echo akina_option('focus_logo_text', ''); ?></h1>
   		<?php elseif (akina_option('focus_logo')):?>
	     <div class="header-tou"><a href="<?php bloginfo('url');?>" ><img src="<?php $img_api = akina_option('focus_logo', '');
	     echo str_replace("{{time()}}",time(),$img_api) ?>"></a></div>
	  	<?php else :?>
         <div class="header-tou" ><a href="<?php bloginfo('url');?>"><img src="<?php bloginfo('template_url'); ?>/images/avatar.jpg"></a></div>	
      	<?php endif; ?>
		<div class="header-info">
            <p>
							<?php 
								$_admin_des_ = akina_option('admin_des');
								if(empty($_admin_des_)){
									echo get_random_word();
								}else{
									echo $_admin_des_;
								}
							?>
						</p>
            <?php if (akina_option('social_style')=="v2"): ?>
            <div class="top-social_v2">
                <li id="bg-pre"><img class="flipx" src="https://cdn.jsdelivr.net/gh/moezx/cdn@3.1.9/img/Sakura/images/next-b.svg"/></li>
                <?php if (akina_option('github')){ ?>
                <li><a href="<?php echo akina_option('github', ''); ?>" target="_blank" class="social-github" title="github"><img src="https://cdn.jsdelivr.net/gh/moezx/cdn@3.1.9/img/Sakura/images/sns/github.png"/></a></li>
                <?php } ?>	
                <?php if (akina_option('sina')){ ?>
                <li><a href="<?php echo akina_option('sina', ''); ?>" target="_blank" class="social-sina" title="sina"><img src="https://cdn.jsdelivr.net/gh/moezx/cdn@3.1.9/img/Sakura/images/sns/sina.png"/></a></li>
                <?php } ?>
                <?php if (akina_option('telegram')){ ?>
                <li><a href="<?php echo akina_option('telegram', ''); ?>" target="_blank" class="social-lofter" title="telegram"><img src="https://cdn.jsdelivr.net/gh/moezx/cdn@3.1.9/img/Sakura/images/sns/telegram.svg"/></a></li>
                <?php } ?>	
                <?php if (akina_option('qq')){ ?>
                <li class="qq"><a href="<?php echo akina_option('qq', ''); ?>" title="Initiate chat ?"><img src="https://cdn.jsdelivr.net/gh/moezx/cdn@3.1.9/img/Sakura/images/sns/qq.png"/></a></li>
                <?php } ?>	
                <?php if (akina_option('qzone')){ ?>
                <li><a href="<?php echo akina_option('qzone', ''); ?>" target="_blank" class="social-qzone" title="qzone"><img src="https://cdn.jsdelivr.net/gh/moezx/cdn@3.1.9/img/Sakura/images/sns/qzone.png"/></a></li>
                <?php } ?>
                <?php if (akina_option('wechat')){ ?>
                <li class="wechat"><a href="#"><img src="https://cdn.jsdelivr.net/gh/moezx/cdn@3.1.9/img/Sakura/images/sns/wechat.png"/></a>
                    <div class="wechatInner">
                        <img src="<?php echo akina_option('wechat', ''); ?>" alt="WeChat">
                    </div>
                </li>
                <?php } ?> 
                <?php if (akina_option('lofter')){ ?>
                <li><a href="<?php echo akina_option('lofter', ''); ?>" target="_blank" class="social-lofter" title="lofter"><img src="https://cdn.jsdelivr.net/gh/moezx/cdn@3.1.9/img/Sakura/images/sns/lofter.png"/></a></li>
                <?php } ?>	
                <?php if (akina_option('bili')){ ?>
                <li><a href="<?php echo akina_option('bili', ''); ?>" target="_blank" class="social-bili" title="bilibili"><img src="https://cdn.jsdelivr.net/gh/moezx/cdn@3.1.9/img/Sakura/images/sns/bilibili.png"/></a></li>
                <?php } ?>
                <?php if (akina_option('youku')){ ?>
                <li><a href="<?php echo akina_option('youku', ''); ?>" target="_blank" class="social-youku" title="youku"><img src="https://cdn.jsdelivr.net/gh/moezx/cdn@3.1.9/img/Sakura/images/sns/youku.png"/></a></li>
                <?php } ?>
                <?php if (akina_option('wangyiyun')){ ?>
                <li><a href="<?php echo akina_option('wangyiyun', ''); ?>" target="_blank" class="social-wangyiyun" title="CloudMusic"><img src="https://cdn.jsdelivr.net/gh/moezx/cdn@3.1.9/img/Sakura/images/sns/wangyiyun.png"/></a></li>
                <?php } ?>
                <?php if (akina_option('twitter')){ ?>
                <li><a href="<?php echo akina_option('twitter', ''); ?>" target="_blank" class="social-wangyiyun" title="Twitter"><img src="https://cdn.jsdelivr.net/gh/moezx/cdn@3.1.9/img/Sakura/images/sns/twitter.png"/></a></li>
                <?php } ?>	
                <?php if (akina_option('facebook')){ ?>
                <li><a href="<?php echo akina_option('facebook', ''); ?>" target="_blank" class="social-wangyiyun" title="Facebook"><img src="https://cdn.jsdelivr.net/gh/moezx/cdn@3.1.9/img/Sakura/images/sns/facebook.png"/></a></li>
                <?php } ?>	
                <?php if (akina_option('jianshu')){ ?>
                <li><a href="<?php echo akina_option('jianshu', ''); ?>" target="_blank" class="social-wangyiyun" title="Jianshu"><img src="https://cdn.jsdelivr.net/gh/moezx/cdn@3.1.9/img/Sakura/images/sns/jianshu.png"/></a></li>
                <?php } ?>
                <?php if (akina_option('zhihu')){ ?>
                <li><a href="<?php echo akina_option('zhihu', ''); ?>" target="_blank" class="social-wangyiyun" title="Zhihu"><img src="https://cdn.jsdelivr.net/gh/moezx/cdn@3.1.9/img/Sakura/images/sns/zhihu.png"/></a></li>
                <?php } ?>	
                <?php if (akina_option('csdn')){ ?>
                <li><a href="<?php echo akina_option('csdn', ''); ?>" target="_blank" class="social-wangyiyun" title="CSDN"><img src="https://cdn.jsdelivr.net/gh/moezx/cdn@3.1.9/img/Sakura/images/sns/csdn.png"/></a></li>
                <?php } ?>		
                <?php if (akina_option('email_name') && akina_option('email_domain')){ ?>
                <li><a onclick="mail_me()" class="social-wangyiyun" title="E-mail"><img src="https://cdn.jsdelivr.net/gh/moezx/cdn@3.1.9/img/Sakura/images/sns/email.svg"/></a></li>
                <?php } ?>	
                <li id="bg-next"><img src="https://cdn.jsdelivr.net/gh/moezx/cdn@3.1.9/img/Sakura/images/next-b.svg"/></li>	
            </div>
            <?php endif; ?>
        </div>
        <?php if (akina_option('social_style')=="v1"): ?>
		<div class="top-social">
		<li id="bg-pre"><img class="flipx" src="https://cdn.jsdelivr.net/gh/moezx/cdn@3.1.9/img/Sakura/images/next-b.svg"/></li>
		<?php if (akina_option('github')){ ?>
		<li><a href="<?php echo akina_option('github', ''); ?>" target="_blank" class="social-github" title="github"><img src="https://cdn.jsdelivr.net/gh/moezx/cdn@3.1.9/img/Sakura/images/sns/github.png"/></a></li>
		<?php } ?>	
		<?php if (akina_option('sina')){ ?>
		<li><a href="<?php echo akina_option('sina', ''); ?>" target="_blank" class="social-sina" title="sina"><img src="https://cdn.jsdelivr.net/gh/moezx/cdn@3.1.9/img/Sakura/images/sns/sina.png"/></a></li>
		<?php } ?>
		<?php if (akina_option('telegram')){ ?>
		<li><a href="<?php echo akina_option('telegram', ''); ?>" target="_blank" class="social-lofter" title="telegram"><img src="https://cdn.jsdelivr.net/gh/moezx/cdn@3.1.9/img/Sakura/images/sns/telegram.svg"/></a></li>
		<?php } ?>	
		<?php if (akina_option('qq')){ ?>
		<li class="qq"><a href="<?php echo akina_option('qq', ''); ?>" title="Initiate chat ?"><img src="https://cdn.jsdelivr.net/gh/moezx/cdn@3.1.9/img/Sakura/images/sns/qq.png"/></a></li>
		<?php } ?>	
		<?php if (akina_option('qzone')){ ?>
		<li><a href="<?php echo akina_option('qzone', ''); ?>" target="_blank" class="social-qzone" title="qzone"><img src="https://cdn.jsdelivr.net/gh/moezx/cdn@3.1.9/img/Sakura/images/sns/qzone.png"/></a></li>
		<?php } ?>
		<?php if (akina_option('wechat')){ ?>
		<li class="wechat"><a href="#"><img src="https://cdn.jsdelivr.net/gh/moezx/cdn@3.1.9/img/Sakura/images/sns/wechat.png"/></a>
			<div class="wechatInner">
				<img src="<?php echo akina_option('wechat', ''); ?>" alt="WeChat">
			</div>
		</li>
		<?php } ?> 
		<?php if (akina_option('lofter')){ ?>
		<li><a href="<?php echo akina_option('lofter', ''); ?>" target="_blank" class="social-lofter" title="lofter"><img src="https://cdn.jsdelivr.net/gh/moezx/cdn@3.1.9/img/Sakura/images/sns/lofter.png"/></a></li>
		<?php } ?>	
		<?php if (akina_option('bili')){ ?>
		<li><a href="<?php echo akina_option('bili', ''); ?>" target="_blank" class="social-bili" title="bilibili"><img src="https://cdn.jsdelivr.net/gh/moezx/cdn@3.1.9/img/Sakura/images/sns/bilibili.png"/></a></li>
		<?php } ?>
		<?php if (akina_option('youku')){ ?>
		<li><a href="<?php echo akina_option('youku', ''); ?>" target="_blank" class="social-youku" title="youku"><img src="https://cdn.jsdelivr.net/gh/moezx/cdn@3.1.9/img/Sakura/images/sns/youku.png"/></a></li>
		<?php } ?>
		<?php if (akina_option('wangyiyun')){ ?>
		<li><a href="<?php echo akina_option('wangyiyun', ''); ?>" target="_blank" class="social-wangyiyun" title="CloudMusic"><img src="https://cdn.jsdelivr.net/gh/moezx/cdn@3.1.9/img/Sakura/images/sns/wangyiyun.png"/></a></li>
		<?php } ?>
		<?php if (akina_option('twitter')){ ?>
		<li><a href="<?php echo akina_option('twitter', ''); ?>" target="_blank" class="social-wangyiyun" title="Twitter"><img src="https://cdn.jsdelivr.net/gh/moezx/cdn@3.1.9/img/Sakura/images/sns/twitter.png"/></a></li>
		<?php } ?>	
		<?php if (akina_option('facebook')){ ?>
		<li><a href="<?php echo akina_option('facebook', ''); ?>" target="_blank" class="social-wangyiyun" title="Facebook"><img src="https://cdn.jsdelivr.net/gh/moezx/cdn@3.1.9/img/Sakura/images/sns/facebook.png"/></a></li>
		<?php } ?>	
		<?php if (akina_option('jianshu')){ ?>
		<li><a href="<?php echo akina_option('jianshu', ''); ?>" target="_blank" class="social-wangyiyun" title="Jianshu"><img src="https://cdn.jsdelivr.net/gh/moezx/cdn@3.1.9/img/Sakura/images/sns/jianshu.png"/></a></li>
		<?php } ?>
		<?php if (akina_option('zhihu')){ ?>
		<li><a href="<?php echo akina_option('zhihu', ''); ?>" target="_blank" class="social-wangyiyun" title="Zhihu"><img src="https://cdn.jsdelivr.net/gh/moezx/cdn@3.1.9/img/Sakura/images/sns/zhihu.png"/></a></li>
		<?php } ?>	
		<?php if (akina_option('csdn')){ ?>
		<li><a href="<?php echo akina_option('csdn', ''); ?>" target="_blank" class="social-wangyiyun" title="CSDN"><img src="https://cdn.jsdelivr.net/gh/moezx/cdn@3.1.9/img/Sakura/images/sns/csdn.png"/></a></li>
		<?php } ?>		
		<?php if (akina_option('email_name') && akina_option('email_domain')){ ?>
		<li><a onclick="mail_me()" class="social-wangyiyun" title="E-mail"><img src="https://cdn.jsdelivr.net/gh/moezx/cdn@3.1.9/img/Sakura/images/sns/email.svg"/></a></li>
		<?php } ?>	
		<li id="bg-next"><img src="https://cdn.jsdelivr.net/gh/moezx/cdn@3.1.9/img/Sakura/images/next-b.svg"/></li>	
	  	</div>
        <?php endif; ?>
	</div>
	<?php } ?>
</figure>
<?php
echo bgvideo(); //BGVideo 
