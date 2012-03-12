<?php

$select = 'codepaste_id, codepaste_name, codepaste_views';
$order  = 'codepaste_id DESC';

$cs_codepaste   = cs_sql_select(__FILE__,'codepaste',$select,'',$order,0,10);

$codepaste_loop = count($cs_codepaste);


if(empty($cs_codepaste)) {

    $data = array();
    echo cs_subtemplate(__FILE__,$data,'codepaste','no_data');
}

else {

    $data = array();

    for($run=0; $run<$codepaste_loop; $run++) {

        $name = strlen($cs_codepaste[$run]['codepaste_name']) <= 20 ? $cs_codepaste[$run]['codepaste_name'] :
                substr($cs_codepaste[$run]['codepaste_name'],0,20) . '...';
        $name = cs_secure($name);
        $cs_codepaste[$run]['codepaste_name']  = $name;
        $cs_codepaste[$run]['codepaste_id']    = $cs_codepaste[$run]['codepaste_id'];
        $cs_codepaste[$run]['codepaste_views'] = $cs_codepaste[$run]['codepaste_views'];
    }

    $data['codepaste'] = $cs_codepaste;
    echo cs_subtemplate(__FILE__,$data,'codepaste','navlist');
}

?>
