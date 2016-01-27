<style>
    .box-container{
        border: 2px solid #000000;
        padding: 5px 10px;
        /*font-family: "ヒラギノ角ゴ Pro W3", "Hiragino Kaku Gothic Pro",Osaka, "メイリオ", Meiryo, "ＭＳ Ｐゴシック", "MS PGothic", sans-serif;*/
        /*font-family: 'Meiryo UI','メイリオ',Verdana,'ＭＳ Ｐゴシック',sans-serif;*/
        font-size: 11px!important;
        line-height: 13px;
        letter-spacing: 0px;
        word-spacing: 0px;
        /*font-size: 12px;*/
    }
    .color-red{
        color: red;
    }
    .font-bold{
        font-weight: bold;
    }
    .h2{
        font-size: 18px;
        margin: 4px 0;
    }
    .box-border-1{
        border: 1px solid #000000;
    }
    .text-center{
        text-align: center;
    }
    table.table {
        width: 100%;
        border-collapse: collapse;
    }
    table.table, .table th, .table td {
        border: 1px solid #000000;
    }
    table{
        font-size: 11px;
        width: 100%;
    }
    .box-part-2{
        width: 50%;
        float: left;
    }
    .box-color-red{
        color: red;
        background-color: rgb(229,229,229);
    }
    .margin-top-5{
        margin-top: 5px!important;
    }
    .clearfix{
        clear: both;
    }
</style>
<div class="box-container">
    <h2 class="h2 text-center">イヤパンク保証サービス保証書＞</h2>
    <div class="box-border-1">
        <div>【サービス概要】</div>
        <div>宇佐美グループ各販売店で購入されたタイヤが本保証書記載のサービス期間中に所定の損害を被った場合、下記の「宇佐美タイヤパンク保証サービス約款」に基づき、所定
            の金額を限度に、宇佐美各販売店にてタイヤの修理・交換をいただくことができます。</div>
        <div>●サービス内容：「宇佐美タイヤパンク保証サービス」はお客様の車両に装着されたタイヤが被ったパンク損害を補償します。
            　　 なお、対象期間中1本あたり１回限りのサービスとなります。</div>
        <div>●対象期間：<span class="color-red font-bold"> タイヤ購入日から６カ月後の応答日まで（半年間）</span></div>
    </div>
    <table class="table margin-top-5">
        <tr>
            <td>
                保証書番号
            </td>
            <td>
                <?php echo isset($info_warranty['number']) ? $info_warranty['number'] : ''; ?>
            </td>
            <td>
                タイヤ購入日
            </td>
            <td>
                <?php echo isset($info_warranty['date']) ? $info_warranty['date'] : ''; ?>
            </td>
            <td>
                対象期間
            </td>
            <td>
                <?php echo isset($info_warranty['expired']) ? $info_warranty['expired'] : ''; ?>
            </td>
        </tr>
    </table>

    <table class="margin-top-5">
        <tr>
            <td>お客様名：　<?php  echo isset($info_car['customer_name']) ? $info_car['customer_name'] : ''; ?></td>
            <td>車名：　<?php  echo isset($info_car['car_name']) ? $info_car['car_name'] : ''; ?></td>
            <td>車番：　<?php  echo isset($info_car['car_license']) ? $info_car['car_license'] : ''; ?></td>
        </tr>
    </table>

    <table class="table margin-top-5">
        <tr>
            <td>
                交換
                箇所
            </td>
            <td>
                メーカー
            </td>
            <td>
                商品名
            </td>
            <td>
                サイズ
            </td>
            <td>
                セリアル
            </td>
            <td>
                サービス利用日
            </td>
            <td>
                お客様
                サイン
            </td>
            <td>
                受付者
                サイン
            </td>
        </tr>
        <tr>
            <td>右前</td>
            <td width="15%">
                <?php echo isset($info_bill['right_front']['info_market']) ? $info_bill['right_front']['info_market'] : ''; ?>
            </td>
            <td width="15%">
                <?php echo isset($info_bill['right_front']['product_name']) ? $info_bill['right_front']['product_name'] : ''; ?>
            </td>
            <td width="15%">
                <?php echo isset($info_bill['right_front']['size']) ? $info_bill['right_front']['size'] : ''; ?>
            </td>
            <td>
                <?php echo isset($info_bill['right_front']['serial']) ? $info_bill['right_front']['serial'] : ''; ?>
            </td>
            <td>年　　月　　日</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>左前</td>
            <td>
                <?php echo isset($info_bill['left_front']['info_market']) ? $info_bill['left_front']['info_market'] : ''; ?>
            </td>
            <td>
                <?php echo isset($info_bill['left_front']['product_name']) ? $info_bill['left_front']['product_name'] : ''; ?>
            </td>
            <td>
                <?php echo isset($info_bill['left_front']['size']) ? $info_bill['left_front']['size'] : ''; ?>
            </td>
            <td>
                <?php echo isset($info_bill['left_front']['serial']) ? $info_bill['left_front']['serial'] : ''; ?>
            </td>
            <td>年　　月　　日</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>右後</td>
            <td>
                <?php echo isset($info_bill['right_behind']['info_market']) ? $info_bill['right_behind']['info_market'] : ''; ?>
            </td>
            <td>
                <?php echo isset($info_bill['right_behind']['product_name']) ? $info_bill['right_behind']['product_name'] : ''; ?>
            </td>
            <td>
                <?php echo isset($info_bill['right_behind']['size']) ? $info_bill['right_behind']['size'] : ''; ?>
            </td>
            <td>
                <?php echo isset($info_bill['right_behind']['serial']) ? $info_bill['right_behind']['serial'] : ''; ?>
            </td>
            <td>年　　月　　日</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>左後</td>
            <td>
                <?php echo isset($info_bill['left_behind']['info_market']) ? $info_bill['left_behind']['info_market'] : ''; ?>
            </td>
            <td>
                <?php echo isset($info_bill['left_behind']['product_name']) ? $info_bill['left_behind']['product_name'] : ''; ?>
            </td>
            <td>
                <?php echo isset($info_bill['left_behind']['size']) ? $info_bill['left_behind']['size'] : ''; ?>
            </td>
            <td>
                <?php echo isset($info_bill['left_behind']['serial']) ? $info_bill['left_behind']['serial'] : ''; ?>
            </td>
            <td>年　　月　　日</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>その他Ａ</td>
            <td>
                <?php echo isset($info_bill['otherA']['info_market']) ? $info_bill['otherA']['info_market'] : ''; ?>
            </td>
            <td>
                <?php echo isset($info_bill['otherA']['product_name']) ? $info_bill['otherA']['product_name'] : ''; ?>
            </td>
            <td>
                <?php echo isset($info_bill['otherA']['size']) ? $info_bill['otherA']['size'] : ''; ?>
            </td>
            <td>
                <?php echo isset($info_bill['otherA']['serial']) ? $info_bill['otherA']['serial'] : ''; ?>
            </td>
            <td>年　　月　　日</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>その他Ｂ</td>
            <td>
                <?php echo isset($info_bill['otherB']['info_market']) ? $info_bill['otherB']['info_market'] : ''; ?>
            </td>
            <td>
                <?php echo isset($info_bill['otherB']['product_name']) ? $info_bill['otherB']['product_name'] : ''; ?>
            </td>
            <td>
                <?php echo isset($info_bill['otherB']['size']) ? $info_bill['otherB']['size'] : ''; ?>
            </td>
            <td>
                <?php echo isset($info_bill['otherB']['serial']) ? $info_bill['otherB']['serial'] : ''; ?>
            </td>
            <td>年　　月　　日</td>
            <td></td>
            <td></td>
        </tr>
    </table>
    <h2 class="h2">＜タイヤパンク保証サービス約款＞</h2>
    <div>
        このサービスは「宇佐美タイヤパンク保証サービス　保証書」に記載されたタイヤ（以下、「対象タイヤ」といいます。）について、以下の条項に基づき一定のサービスのご提供を
        お約束するものです。　尚、サービスのご提供にあたりましては、「Usappyカード」、「宇佐美カード」にご加入いただいていることが必要となります。
    </div>

    <div class="clearfix">
        <div class="box-part-2">
            <div>【サービス提供の条件】</div>
            <div>第１条 宇佐美グループ各販売店にて購入された対象タイヤに対して、サービス提供を行います。</div>
            <div>＊ただし各販売店の判断により本サービス提供の対象としない場合もあります。</div>
            <div>２.サービス提供にあたりましては、保証書および作業伝票のご提出をいただくことが必要となります。</div>
            <div>３.以下のタイヤメーカー各社の製造タイヤに対して、本サービスの提供を行ないます。</div>
            <div>〈㈱ブリヂストン、横浜ゴム工業㈱、住友ゴム工業㈱、東洋ゴム工業㈱＞</div>
            <div class="color-red">※乗用車用タイヤに限る。</div>
            <div>【サービス内容】</div>
            <div>第２条 第5条に定めるサービスの対象期間中に日本国内において、「対象タイヤのパンク」が発生</div>
            <div>したお車に対してサービス提供を行います。</div>
            <div>２．前項に掲げる「対象タイヤのパンク」とは、次に挙げるタイヤに対する損害をさします。</div>
            <div>・ タイヤの裂け</div>
            <div>・ サイドウォール部の「ピンチカット（内部構造破壊によるタイヤの膨れ）」</div>
            <div>・ タイヤ内部構造の流出</div>
            <div>・ その他、走行に重大な支障をきたすおそれがあるタイヤの損傷ただし、以下の場合は本サービスの対象となりません。</div>
            <div>・ タイヤビード部、エアバルブからのエア漏れによる内圧低下であって外傷がないもの</div>
            <div>・ 空気圧不足に起因するタイヤバースト（釘ふみなどによるものを除く）</div>
            <div>・ 全装着タイヤの一部でも道路交通法に定められる保安基準残溝1.6ｍｍを満たさない場合の事故</div>
            <div>３．サービスの提供は、タイヤの修理・交換にて実施し、金銭での支払いはしません。</div>
            <div>４．タイヤの交換を実施する場合は、交換前タイヤと同一タイヤによる交換となります。なお同一タ
                イヤが無い場合は、同等タイヤによる交換となります。</div>
            <div>【サービスの限度額】</div>
            <div>第３条 前条に記載のサービスは、下記に掲げるサービス限度額を上限に実施します。</div>
            <div>・サービス上限額 １本あたり５０，０００円（税込）※タイヤ修理・交換工賃含む</div>
            <div>【サービスの実施回数】</div>
            <div>第４条 サービスの提供は１本あたりサービス期間中１回に限るものとします。</div>
            <div class="color-red">※一回の事故によるパンクのみがサービス提供の対象となります。</div>
            <div>【サービスの対象期間】</div>
            <div>第５条 サービスの対象期間は、タイヤ購入日から６カ月後の応答日の午後１２時までとします。 </div>
            <div>【サービスの提供場所】</div>
            <div>第６条 サービスの提供を受ける場合には、お客様が宇佐美グループ各販売店へ対象タイヤをお持
                ちいただき、保証書および作業伝票をご提示の上、お申し付けください。宇佐美グループ各販売店
                以外でタイヤを購入・修理・交換された場合、本サービスはご利用いただけません。尚、<span class="color-red">タイヤの修
            理・交換の作業対象時間は8:00～18:00</span>（※一部店舗においては作業対象時間が異なる場
                合があります）とさせていただきます。
            </div>
            <div class="box-border-1 margin-top-5">
                【サービス提供者】<br />
                株式会社　宇佐美鉱油 <br />
                〒450-0003　愛知県名古屋市中村区名駅南1-15-21宇佐美名古屋ビル
                ※保証書およびサービス約款に記載のグループ会社とは下記の会社となります。
                <br />
                ＜ ㈱東日本宇佐美 ・ ㈱西日本宇佐美 ＞
            </div>
        </div>
        <div class="box-part-2">
            <div class="box-color-red">
                サービスを行なわない事項><br />
                第７条 次の場合は、サービスの対象期間中の事故であってもサービスはご利用いただけません。<br />
                （１）宇佐美グループ各販売店以外で対象タイヤの購入・交換を依頼された場合<br />
                （２）保証書の提出がない場合、保証書に所定の記載事項の記載がない場合または記載事<br />
                項が故意に変更された場合<br />
                （３）対象タイヤを第三者へ譲渡または贈呈された場合<br />
                （４）タイヤの組み換え、脱着をされた場合<br />
                （５）盗難によるタイヤ紛失が発生した場合<br />
                （６）対象の車両から取り外したタイヤのみを持ち込まれた場合<br />
                （７）損害発生の日から３０日以内に対象タイヤの購入・交換のために入庫されなかった場合<br />
                （８）直接・間接を問わず、次に掲げる事由によって生じた損傷<br />
                ①お客様、お客様の同居のご親族又はお客様の許可を得て対象タイヤを装着した自動車を使<br />
                用した者の故意の事故<br />
                ②対象タイヤを装着した自動車の運転者が法令により定められた運転資格を持たないで、また<br />
                は酒に酔ってもしくは麻薬、大麻、あへん、覚せい剤、シンナー等の影響により正常に運転できな<br />
                いおそれがある状態で対象自動車を運転している場合<br />
                ③地震もしくは噴火またはこれらによる津波災害<br />
                ④核燃料物質（使用済み燃料を含みます。以下同様とします。）もしくは核燃料物質によって<br />
                汚染されたもの（原子核分裂生成物を含みます。）の放射性、爆発性その他の有害な特性に<br />
                よる事故<br />
                ⑤戦争・外国の武力行使・革命・政権奪取・内乱・武装反乱・その他の類似の事変または暴動<br />
                （群衆または多数の者の集団行動によって全国または一部の地区において著しく平穏が害さ<br />
                れ、治安維持上重大な事態と認められる状態をいいます）<br />
                ⑥差押え、収用、没収、破壊など国または公共団体の公権力の行使<br />
                ⑦詐欺または横領<br />
                ⑧対象タイヤを装着した自動車の不適切な保管、仕様の限度を超える過酷な仕様（レース、ラ
                リー等による過酷な走行）による事故<br />
                ⑨違法改造車両による事故<br />
                ⑩危険走行（ドリフト走行、ローリング走行、ゼロヨン走行　等）による事故<br />
                ⑪車両走行上問題のないタイヤ損害（塗装料付着によるタイヤ汚損損害　等）<br />
                ⑫ランフラットタイヤ・持ち帰りタイヤに発生した事故<br />
            </div>
            【適用地域】<br />
            <div style="margin-left: 4px;"> 第８条　　本サービスは日本国内においてのみ有効です。</div>
            <div style="margin-top: 92px;margin-left: 20px;">
                保証書発行店舗<br />
                <div class="box-border-1">
                    <?php echo isset($info_ss['name']) ? $info_ss['name'] : ''; ?><br />
                    <?php echo isset($info_ss['address']) ? $info_ss['address'] : ''; ?><br />
                    <?php echo isset($info_ss['mobile']) ? $info_ss['mobile'] : ''; ?>
                </div>
            </div>
        </div>
    </div>
</div>
