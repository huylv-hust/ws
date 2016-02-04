<script src="<?php echo \yii\helpers\BaseUrl::base(true) ?>/js/module/maintenance.js"></script>
<main id="contents">
    <section class="readme">
        <h2 class="titleContent">作業者一覧</h2>
    </section>
    <article class="container">
        <?php if(Yii::$app->session->hasFlash('success')) {?>
        <div class="alert alert-danger"><?php echo Yii::$app->session->getFlash('success')?>
            <button data-dismiss="alert" class="close">×</button>
        </div>
        <?php }?>
        <form class="formSearchList" action="" method="get">
            <section class="bgContent">
                <div class="formGroup">
                    <div class="formItem">
                        <label class="titleLabel">支店<span class="must">*</span></label>
                        <?= \yii\helpers\Html::dropDownList('M08_HAN_CD', isset($filters['M08_HAN_CD']) ? $filters['M08_HAN_CD'] : '', $all_branch, array('class' => 'selectForm', 'id' => 'selectBranch')) ?>
                    </div>
                    <div class="formItem">
                        <label class="titleLabel">SS<span class="must">*</span></label>
                        <?= \yii\helpers\Html::dropDownList('M08_SS_CD', isset($filters['M08_SS_CD']) ? $filters['M08_SS_CD'] : '', $all_ss_search, array('class' => 'selectForm', 'id' => 'selectSS')) ?>
                    </div>
                </div>
            </section>
            <section class="areaSearch"><a href="javascript:void(0)" class="btnSearch">検索</a></section>
        </form>
        <section class="nolineContent">
            <!-- <div class="noData">入力条件に該当する作業者が存在しません。</div> -->
            <nav class="paging">
                <?php
                echo \yii\widgets\LinkPager::widget([
                    'pagination' => $pagination,
                    'nextPageLabel' => '&gt;',
                    'prevPageLabel' => '&lt;',
                    'firstPageLabel' => '&laquo;',
                    'lastPageLabel' => '&raquo;',
                ]);
                ?>
            </nav>
            <table class="tableList">
                <tbody>
                <tr>
                    <th>販売店名</th>
                    <th>SS名</th>
                    <th>表示順</th>
                    <th>従業員CD</th>
                    <th>作業者名</th>
                </tr>
                <?php
                    foreach($staffs as $staff) {
                ?>
                <tr>
                    <td>
                        <?php echo isset($all_branch[$staff['M08_HAN_CD']]) ? $all_branch[$staff['M08_HAN_CD']] : '';?>
                    </td>
                    <td><?php echo isset($all_ss[$staff['M08_SS_CD']]) ? $all_ss[$staff['M08_SS_CD']] : '';?></td>
                    <td><?php echo $staff['M08_ORDER'];?></td>
                    <td><?php echo $staff['M08_JYUG_CD'];?></td>
                    <td>
                        <a href="<?php echo \yii\helpers\BaseUrl::base(true) ?>/edit-staff?branch=<?php echo $staff['M08_HAN_CD'];?>&ss=<?php echo $staff['M08_SS_CD']?>&cd=<?php echo $staff['M08_JYUG_CD']?>">
                            <?php echo $staff['M08_NAME_SEI'].$staff['M08_NAME_MEI'];?>
                        </a>
                    </td>
                </tr>
                <?php
                    }
                ?>
                </tbody>
            </table>
            <nav class="paging">
                <nav class="paging">
                    <?php
                    echo \yii\widgets\LinkPager::widget([
                        'pagination' => $pagination,
                        'nextPageLabel' => '&gt;',
                        'prevPageLabel' => '&lt;',
                        'firstPageLabel' => '&laquo;',
                        'lastPageLabel' => '&raquo;',
                    ]);
                    ?>
                </nav>
            </nav>
        </section>
    </article>
</main>
<footer id="footer">
    <div class="toolbar"><a class="btnBack" href="<?php echo \yii\helpers\BaseUrl::base(true) ?>">戻る</a><a
            class="btnSubmit" href="<?php echo \yii\helpers\BaseUrl::base(true) ?>/regist-staff">新規登録</a></div>
    <p class="copyright">Copyright(C) Usami Koyu Corp. All Rights Reserved.</p>
</footer>