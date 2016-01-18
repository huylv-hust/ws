<script src="<?php echo yii\helpers\BaseUrl::base(true).'/js/module/search.js'?>"></script>
<main id="contents">
    <section class="readme">
        <h2 class="titleContent">情報検索</h2>
    </section>
    <article class="container">
        <?php if (Yii::$app->session->hasFlash('success')) {?>
        <div class="alert alert-danger"><?php echo Yii::$app->session->getFlash('success')?>
            <button class="close" data-dismiss="alert">&times;</button>
        </div>
        <?php }?>
        <form action="" method="get" class="formSearchList">
            <section class="bgContent">
                <div class="formGroup">
                    <div class="formItem">
                        <label class="titleLabel">施行日（予約日）<span class="must">*</span></label>
                        <?= yii\helpers\Html::input('text', 'start_time', isset($filters['start_time']) ? $filters['start_time'] : '', ['class' => 'textForm']) ?>
                        <span class="txtUnit">〜</span>
                        <?= yii\helpers\Html::input('text', 'end_time', isset($filters['end_time']) ? $filters['end_time'] : '', ['class' => 'textForm']) ?>
                        <span class="txtExample">例)YYYYMMDD~YYYYMMDD</span> </div>
                </div>
                <div class="formGroup">
                    <div class="formItem">
                        <label class="titleLabel">データ確認</label>
                        <?= yii\helpers\Html::dropDownList('status',isset($filters['status']) ? $filters['status'] : '', $status, array('class' => 'selectForm', 'id' => 'status'))?>
                    </div>
                    <div class="formItem">
                        <label class="titleLabel">車両No.</label>
                        <?= yii\helpers\Html::input('text', 'car', isset($filters['car']) ? $filters['car'] : '', ['class' => 'textForm']) ?>
                    </div>
                    <div class="formItem">
                        <label class="titleLabel">作業内容</label>
                        <?= yii\helpers\Html::dropDownList('job',isset($filters['job']) ? $filters['job'] : '', $job, array('class' => 'selectForm', 'id' => 'selectJob'))?>
                    </div>
                </div>
            </section>
            <section class="areaSearch">
                <a href="#" class="btnSearch">検索</a>
            </section>

        </form>
        <section class="nolineContent">
            <!-- <div class="noData">入力条件に該当する作業伝票が存在しません。</div> -->
            <nav class="paging">
                <?php
                    echo yii\widgets\LinkPager::widget([
                        'pagination' => $pagination,
                    ]);
                ?>
            </nav>
            <table class="tableList">
                <tr>
                    <th>No.</th>
                    <th>伝票No.</th>
                    <th>SSコード</th>
                    <th>SS名</th>
                    <th>施行日（予約日）</th>
                    <th>データ確認</th>
                    <th>お客様名</th>
                    <th>作業内容</th>
                    <th>作業確認</th>
                </tr>
                <?php $i =1; foreach($list as $k => $v) {?>
                <tr>
                    <td><?php echo $i++ ;?></td>
                    <td><a href="<?php echo \yii\helpers\BaseUrl::base(true) ?>/detail-workslip.html?den_no=<?php echo $v['D03_DEN_NO'];?>"><?php echo $v['D03_DEN_NO'];?></a></td>
                    <td><?php echo $v['D03_SS_CD'];?></td>
                    <td><?php echo $all_ss[$v['D03_SS_CD']];?></td>
                    <td><?php echo $v['D03_SEKOU_YMD'];?></td>
                    <td><?php echo $v['D03_STATUS'];?></td>
                    <td><?php echo $v['D01_CUST_NAMEN'];?></td>
                    <td>
                        <?php
                        $job_no = \backend\modules\listworkslip\controllers\DefaultController::getJob($v['D03_DEN_NO']);
                        $job_name = '';
                        foreach ($job_no as $key => $val) {
                            $job_name.= $job[$val].',';
                        }
                        $job_name = trim($job_name, ',');
                        echo $job_name;
                        ?>
                    </td>
                    <td><a class="iconPreview" target="_blank" href="<?php echo \yii\helpers\BaseUrl::base(true) ?>/preview.html?den_no=<?php echo $v['D03_DEN_NO'];?>"></a></td>
                </tr>
                <?php }?>
            </table>
            <nav class="paging">
                <?php
                    echo yii\widgets\LinkPager::widget([
                        'pagination' => $pagination,
                    ]);
                ?>
                </nav>
        </section>
    </article>
</main>
<footer id="footer">
    <div class="toolbar"><a href="<?php echo \yii\helpers\BaseUrl::base(true).'/menu.html'; ?>" class="btnBack">戻る</a></div>
    <p class="copyright">Copyright(C) Usami Koyu Corp. All Rights Reserved.</p>
</footer>