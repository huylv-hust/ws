<script src="<?php echo yii\helpers\BaseUrl::base(true) . '/js/module/listworkslip.js' ?>"></script>
<main id="contents">
    <section class="readme">
        <h2 class="titleContent">情報検索</h2>
    </section>
    <article class="container">
        <?php if (Yii::$app->session->hasFlash('success')) { ?>
            <div class="alert alert-danger"><?php echo Yii::$app->session->getFlash('success') ?>
                <button class="close" data-dismiss="alert">&times;</button>
            </div>
        <?php } ?>
        <form action="" method="get" class="formSearchList" id="listworkslip">
            <section class="bgContent">
                <div class="formGroup">
                    <div class="formItem">
                        <label class="titleLabel">施行日（予約日）<span class="must">*</span></label>
                        <?= yii\helpers\Html::input('text', 'start_time', isset($filters['start_time']) ? $filters['start_time'] : date('Ymd'), ['class' => 'textForm dateform', 'maxlength' => '8', 'id' => 'start_time']) ?>
                        <span class="txtUnit">〜</span>
                        <?= yii\helpers\Html::input('text', 'end_time', isset($filters['end_time']) ? $filters['end_time'] : date('Ymd'), ['class' => 'textForm dateform', 'maxlength' => '8', 'id' => 'end_time']) ?>
                        <span class="txtExample">例)YYYYMMDD~YYYYMMDD</span></div>
                </div>
                <div class="formGroup">
                    <div class="formItem">
                        <label class="titleLabel">データ確認</label>
                        <?= yii\helpers\Html::dropDownList('status', isset($filters['status']) ? $filters['status'] : '', $status, array('class' => 'selectForm', 'id' => 'status')) ?>
                    </div>
                    <div class="formItem">
                        <label class="titleLabel">車両No.</label>
                        <?= yii\helpers\Html::input('text', 'car', isset($filters['car']) ? $filters['car'] : '', ['class' => 'textForm', 'maxlength' => '4', 'id' => 'car']) ?>
                    </div>
                    <div class="formItem">
                        <label class="titleLabel">作業内容</label>
                        <?= yii\helpers\Html::dropDownList('job', isset($filters['job']) ? $filters['job'] : '', $job, array('class' => 'selectForm', 'id' => 'selectJob')) ?>
                    </div>
                </div>
            </section>
            <section class="areaSearch">
                <a href="#" class="btnSearch">検索</a>
            </section>

        </form>
        <section class="nolineContent">
            <?php if (Yii::$app->session->hasFlash('empty')) { ?>
                <div class="noData"><?php echo Yii::$app->session->getFlash('empty'); ?></div>
            <?php } else { ?>
                <nav class="paging">
                    <?php
                    echo yii\widgets\LinkPager::widget([
                        'pagination' => $pagination,
                        'nextPageLabel' => '&gt;',
                        'prevPageLabel' => '&lt;',
                        'firstPageLabel' => '&laquo;',
                        'lastPageLabel' => '&raquo;',
                    ]);
                    ?>
                </nav>
                <table class="tableList">
                    <tr style="max-width: 100%">
                        <th style="min-width: 49px;">No.</th>
                        <th style="min-width: 85px;">伝票No.</th>
                        <th style="min-width: 99px;">SSコード</th>
                        <th style="max-width: 20%;min-width: 164px;">SS名</th>
                        <th style="min-width: 164px;">施行日（予約日）</th>
                        <th style="min-width: 110px;">データ確認</th>
                        <th style="max-width: 20%;min-width: 164px;">お客様名</th>
                        <th style="max-width: 25%;min-width: 200px;">作業内容</th>
                        <th style="min-width: 93px;">作業確認</th>
                    </tr>
                    <?php
                    if (isset($page)) {
                        $i = 1 + 20 * ($page - 1);
                    } else {
                        $i = 1;
                    }
                    foreach ($list as $k => $v) { ?>
                        <tr>
                            <td><?php echo $i++; ?></td>
                            <td>
                                <a href="<?php echo \yii\helpers\BaseUrl::base(true) ?>/detail-workslip?den_no=<?php echo $v['D03_DEN_NO']; ?>"><?php echo $v['D03_DEN_NO']; ?></a>
                            </td>
                            <td><?php echo $v['D03_SS_CD']; ?></td>
                            <td><?php
                                if (isset($all_ss[$v['D03_SS_CD']])) {
                                    echo $all_ss[$v['D03_SS_CD']];
                                } else {
                                    echo '';
                                } ?></td>
                            <td><?php echo $v['D03_SEKOU_YMD']; ?></td>
                            <td>
                                <?php
                                if ($v['D03_STATUS'] == 1) {
                                    echo $status[2];
                                }
                                if ($v['D03_STATUS'] != '' && $v['D03_STATUS'] == 0 && $v['D03_SEKOU_YMD'] <= date('Ymd')) {
                                    echo $status[0];
                                }
                                if ($v['D03_STATUS'] != '' && $v['D03_STATUS'] == 0 && $v['D03_SEKOU_YMD'] > date('Ymd')) {
                                    echo $status[1];
                                } ?>
                            </td>
                            <td><?php echo $v['D01_CUST_NAMEN']; ?></td>
                            <td>
                                <?php
                                $job_no = \backend\modules\listworkslip\controllers\DefaultController::getJob($v['D03_DEN_NO']);
                                $job_name = '';
                                foreach ($job_no as $key => $val) {
                                    $job_name .= $job[$val] . '、';
                                }
                                $job_name = preg_replace('/、$/', '', $job_name);
                                echo $job_name;
                                ?>
                            </td>
                            <td><a class="iconPreview" target="_blank"
                                   href="<?php echo \yii\helpers\BaseUrl::base(true) ?>/preview?den_no=<?php echo $v['D03_DEN_NO']; ?>"></a>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
                <nav class="paging">
                    <?php
                    echo yii\widgets\LinkPager::widget([
                        'pagination' => $pagination,
                        'nextPageLabel' => '&gt;',
                        'prevPageLabel' => '&lt;',
                        'firstPageLabel' => '&laquo;',
                        'lastPageLabel' => '&raquo;',
                    ]);
                    ?>
                </nav>
            <?php } ?>
        </section>
    </article>
</main>
<footer id="footer">
    <div class="toolbar"><a href="<?php echo \yii\helpers\BaseUrl::base(true) . '/menu'; ?>" class="btnBack">戻る</a>
    </div>
    <p class="copyright">Copyright(C) Usami Koyu Corp. All Rights Reserved.</p>
</footer>