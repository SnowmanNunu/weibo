<div class="tab_wrap">
      <ul>
        <li>相关文章</li>
      </ul>
      <div class="news_min">
          {#tlbContent#}
      </div>

   </div>

<?php

			 $tlbContent="";
			 $sql2="select addtime,filename,title from $tab where status=1 and thdClassId=$thdClassId order by id desc limit 0,10";
			   $info2=$news->select($sql2);
			   if($info2){
			   foreach($info2 as $item2){

				  $linkUrl="/".$artdir."/".str_replace("-","",substr($item2[addtime],0,7))."/".$item2[filename];
				   $tlbContent.='<li><a href="'.$linkUrl.'" title='.$item2[title].'>'.cut_str($item2[title],18).'</a></li>';
			     }
			  }



        //    yx_user_web   relName   webName
        //    yx_artcle
        $lvshiContent="";
        $sq13="select contentInfo from yx_artcle ";
