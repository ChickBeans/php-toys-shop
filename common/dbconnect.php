<?php
try {
    $db = new PDO('mysql:dbname=php_shop;host=localhost;utf8', 'root', 'root');
} catch (PDOException $e) {
    echo '接続エラー：' . $e->getMessage();
    exit();
}

function connect_db() {
    try {
        $db = new PDO('mysql:dbname=php_shop;host=localhost;utf8', 'root', 'root');
        return $db;
    } catch (PDOException $e) {
        echo '接続エラー：' . $e->getMessage();
        exit();
    }
}

function get_order($post)
{
    $db = connect_db();
    $stmt = $db->prepare(
        'SELECT 
          ds.id,
          ds.date,
          ds.member_id,
          ds.name AS ds_name,
          ds.email,
          ds.postal1,
          ds.postal2,
          ds.address,
          ds.tel,
          dsp.product_id,
          mp.name AS mp_name,
          dsp.price,
          dsp.quantity
        FROM dat_sales ds,
        dat_sales_product dsp,
        mst_product mp
        WHERE ds.id = dsp.sales_id
        AND dsp.product_id = mp.id
        AND substr(ds.date, 1, 4)=?
        AND substr(ds.date, 6, 2)=?
        AND substr(ds.date, 9, 2)=?'
    );
    $stmt->execute(array(
        $post['year'],
        $post['month'],
        $post['day']
    ));
    return $stmt;
}
