<?php

$textTpl = "<xml>
			 <ToUserName><![CDATA[toUser]]></ToUserName>
			 <FromUserName><![CDATA[fromUser]]></FromUserName> 
			 <CreateTime>1348831860</CreateTime>
			 <MsgType><![CDATA[text]]></MsgType>
			 <Content><![CDATA[this is a test]]></Content>
			 <MsgId>1234567890123456</MsgId>
			 </xml>";

$imageTpl = " <xml>
			 <ToUserName><![CDATA[toUser]]></ToUserName>
			 <FromUserName><![CDATA[fromUser]]></FromUserName>
			 <CreateTime>1348831860</CreateTime>
			 <MsgType><![CDATA[image]]></MsgType>
			 <PicUrl><![CDATA[this is a url]]></PicUrl>
			 <MsgId>1234567890123456</MsgId>
			 </xml>";

$locationTpl = "<xml>
				<ToUserName><![CDATA[toUser]]></ToUserName>
				<FromUserName><![CDATA[fromUser]]></FromUserName>
				<CreateTime>1351776360</CreateTime>
				<MsgType><![CDATA[location]]></MsgType>
				<Location_X>23.134521</Location_X>
				<Location_Y>113.358803</Location_Y>
				<Scale>20</Scale>
				<Label><![CDATA[位置信息]]></Label>
				<MsgId>1234567890123456</MsgId>
				</xml>";

$linkTpl = "<xml>
				<ToUserName><![CDATA[toUser]]></ToUserName>
				<FromUserName><![CDATA[fromUser]]></FromUserName>
				<CreateTime>1351776360</CreateTime>
				<MsgType><![CDATA[link]]></MsgType>
				<Title><![CDATA[公众平台官网链接]]></Title>
				<Description><![CDATA[公众平台官网链接]]></Description>
				<Url><![CDATA[url]]></Url>
				<MsgId>1234567890123456</MsgId>
				</xml>";

$eventTpl = "<xml><ToUserName><![CDATA[toUser]]></ToUserName>
			<FromUserName><![CDATA[FromUser]]></FromUserName>
			<CreateTime>123456789</CreateTime>
			<MsgType><![CDATA[event]]></MsgType>
			<Event><![CDATA[EVENT]]></Event>
			<EventKey><![CDATA[EVENTKEY]]></EventKey>
			</xml>";

$musicTpl = " <xml>
				 <ToUserName><![CDATA[toUser]]></ToUserName>
				 <FromUserName><![CDATA[fromUser]]></FromUserName>
				 <CreateTime>12345678</CreateTime>
				 <MsgType><![CDATA[music]]></MsgType>
				 <Music>
				 <Title><![CDATA[TITLE]]></Title>
				 <Description><![CDATA[DESCRIPTION]]></Description>
				 <MusicUrl><![CDATA[MUSIC_Url]]></MusicUrl>
				 <HQMusicUrl><![CDATA[HQ_MUSIC_Url]]></HQMusicUrl>
				 </Music>
				 </xml>";

$newsTpl = "<xml>
			 <ToUserName><![CDATA[toUser]]></ToUserName>
			 <FromUserName><![CDATA[fromUser]]></FromUserName>
			 <CreateTime>12345678</CreateTime>
			 <MsgType><![CDATA[news]]></MsgType>
			 <ArticleCount>2</ArticleCount>
			 <Articles>
			 <item>
			 <Title><![CDATA[title1]]></Title> 
			 <Description><![CDATA[description1]]></Description>
			 <PicUrl><![CDATA[picurl]]></PicUrl>
			 <Url><![CDATA[url]]></Url>
			 </item>
			 <item>
			 <Title><![CDATA[title]]></Title>
			 <Description><![CDATA[description]]></Description>
			 <PicUrl><![CDATA[picurl]]></PicUrl>
			 <Url><![CDATA[url]]></Url>
			 </item>
			 </Articles>
			 </xml>";
?>
