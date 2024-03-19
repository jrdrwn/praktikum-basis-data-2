# no 1
call deletePembelianSparepart('ISP5');
call InsertPembelianSparepart('ISP5', 'TRX4', 'SPT4', 5);

select id_sparepart, sum(jumlah_beli) as jumlah_beli_sparepart
from pembelian_sparepart
group by id_sparepart
order by jumlah_beli_sparepart desc
limit 1;

call DeletePembelianService('ISP5');
call DeletePembelianService('ISP6');
call InsertPembelianService('ISV5', 'TRX3', 'SRV4', 'PGW4');
call InsertPembelianService('ISV6', 'TRX2', 'SRV4', 'PGW4');

select id_service, count(id_service) as jumlah_beli_service
from pembelian_service
group by id_service
order by jumlah_beli_service desc
limit 1;

select *
from (select id_sparepart, sum(jumlah_beli) as jumlah_beli_sparepart
      from pembelian_sparepart
      group by id_sparepart
      order by jumlah_beli_sparepart desc
      limit 1) as t1,
     (select id_service, count(id_service) as jumlah_beli_service
      from pembelian_service
      group by id_service
      order by jumlah_beli_service desc
      limit 1) as t2;

delimiter $$
create procedure getPembelianSparepartDanServiceTerbanyak()
begin
    select *
    from (select id_sparepart, sum(jumlah_beli) as jumlah_beli_sparepart
          from pembelian_sparepart
          group by id_sparepart
          order by jumlah_beli_sparepart desc
          limit 1) as t1,
         (select id_service, count(id_service) as jumlah_beli_service
          from pembelian_service
          group by id_service
          order by jumlah_beli_service desc
          limit 1) as t2;
end$$
delimiter ;

call getPembelianSparepartDanServiceTerbanyak();

# no 2
select *
from sparepart;
select *
from service;

select harga as harga_sparepart
from sparepart
order by harga_sparepart desc
limit 1;
select harga as harga_service
from service
order by harga_service desc
limit 1;

select *
from (select id_sparepart, harga as harga_sparepart from sparepart order by harga_sparepart desc limit 1) as t1,
     (select id_service, harga as harga_service from service order by harga_service desc limit 1) as t2;

delimiter $$
create procedure getHargaSparepartDanServiceTertinggi()
begin
    select *
    from (select id_sparepart, harga as harga_sparepart from sparepart order by harga_sparepart desc limit 1) as t1,
         (select id_service, harga as harga_service from service order by harga_service desc limit 1) as t2;
end$$

delimiter ;

call getHargaSparepartDanServiceTertinggi();

# no 3
select *
from (select id_sparepart, harga as harga_sparepart from sparepart order by harga_sparepart limit 1) as t1,
     (select id_service, harga as harga_service from service order by harga_service limit 1) as t2;

delimiter $$
create procedure getHargaSparepartDanServiceTermurah()
begin
    select *
    from (select id_sparepart, harga as harga_sparepart from sparepart order by harga_sparepart limit 1) as t1,
         (select id_service, harga as harga_service from service order by harga_service limit 1) as t2;
end$$

delimiter ;

call getHargaSparepartDanServiceTermurah();

# no 4
select *
from pembelian_sparepart;
select id_sparepart, count(id_sparepart) as jumlah_transaksi
from pembelian_sparepart
group by id_sparepart
order by jumlah_transaksi desc;

delimiter $$
create procedure getTotalTransaksiSetiapSparepart()
begin
    select id_sparepart, count(id_sparepart) as jumlah_transaksi
    from pembelian_sparepart
    group by id_sparepart
    order by jumlah_transaksi desc;
end$$

delimiter ;

call getTotalTransaksiSetiapSparepart();

# no 5 (entah)
select concat(substr(lower(nama_pelanggan), 1, 3), id_pelanggan)
from pelanggan;
select concat(substr(lower(p.nama_pegawai), 1, 3), replace(t.tanggal_pembelian, '-', ''), substr(rand(), 3, 5))
from header_transaksi ht
         join transaksi t on ht.id_transaksi = t.id_transaksi
         join pegawai p on ht.id_pegawai = p.id_pegawai;

select concat(new_id_pln, new_id_pgw)
from (select concat(substr(lower(nama_pelanggan), 1, 3), id_pelanggan) as new_id_pln from pelanggan) as t1,
     (select concat(substr(lower(p.nama_pegawai), 1, 3), replace(t.tanggal_pembelian, '-', ''),
                    substr(rand(), 3, 5)) as new_id_pgw
      from header_transaksi ht
               join transaksi t on ht.id_transaksi = t.id_transaksi
               join pegawai p on ht.id_pegawai = p.id_pegawai) as t2;

delimiter $$
create function getNewIdPelangganDanPegawai(id_pelanggan_p varchar(255), id_pegawai_p varchar(255))
    returns varchar(255)
    deterministic
begin
    declare new_id varchar(255);
    select concat(new_id_pln, new_id_pgw)
    into new_id
    from (select concat(substr(lower(nama_pelanggan), 1, 3), id_pelanggan) as new_id_pln
          from pelanggan
          where id_pelanggan = id_pelanggan_p) as t1,
         (select concat(substr(lower(p.nama_pegawai), 1, 3), replace(t.tanggal_pembelian, '-', ''),
                        substr(rand(), 3, 5)) as new_id_pgw
          from header_transaksi ht
                   join transaksi t on ht.id_transaksi = t.id_transaksi
                   join pegawai p on ht.id_pegawai = p.id_pegawai
          where p.id_pegawai = id_pegawai_p) as t2;
    return new_id;
end$$
delimiter ;

select getNewIdPelangganDanPegawai('PLN0', 'PGW0');

drop function getNewIdPelangganDanPegawai;

# no 5 revisi
select *
from transaksi;
select p.id_pelanggan, p.nama_pelanggan, t.tanggal_pembelian, pgw.id_pegawai
from pelanggan p
         join transaksi t on t.id_pelanggan = p.id_pelanggan
         join header_transaksi ht on ht.id_transaksi = t.id_transaksi
         join pegawai pgw on ht.id_pegawai = pgw.id_pegawai
where t.id_transaksi = 'TRX1';

select concat(substr(lower(p.nama_pelanggan), 1, 3), p.id_pelanggan, substr(lower(pgw.nama_pegawai), 1, 3),
              replace(t.tanggal_pembelian, '-', ''),
              substr(rand(), 3, 5))
from pelanggan p
         join transaksi t on t.id_pelanggan = p.id_pelanggan
         join header_transaksi ht on ht.id_transaksi = t.id_transaksi
         join pegawai pgw on ht.id_pegawai = pgw.id_pegawai
where t.id_transaksi = 'TRX0';

delimiter $$
create function getNewIdPembelianSparepart(id_transaksi_p varchar(50))
    returns varchar(50)
    deterministic
begin
    declare new_id varchar(50);
    select concat(substr(lower(p.nama_pelanggan), 1, 3), p.id_pelanggan, substr(lower(pgw.nama_pegawai), 1, 3),
                  replace(t.tanggal_pembelian, '-', ''),
                  substr(rand(), 3, 5))
    into new_id
    from pelanggan p
             join transaksi t on t.id_pelanggan = p.id_pelanggan
             join header_transaksi ht on ht.id_transaksi = t.id_transaksi
             join pegawai pgw on ht.id_pegawai = pgw.id_pegawai
    where t.id_transaksi = id_transaksi_p;
    return new_id;
end$$
delimiter ;

select getNewIdPembelianSparepart('TRX3');

# no 6

select *
from transaksi;
select t.id_transaksi, p.id_pelanggan, p.nama_pelanggan, pgw.nama_pegawai
from pelanggan p
         join transaksi t on t.id_pelanggan = p.id_pelanggan
         join header_transaksi ht on ht.id_transaksi = t.id_transaksi
         join pegawai pgw on ht.id_pegawai = pgw.id_pegawai
where t.id_transaksi = 'TRX1';

select concat(substr(lower(p.nama_pelanggan), 1, 3), t.id_transaksi, substr(lower(pgw.nama_pegawai), 1, 3),
              p.id_pelanggan,
              substr(rand(), 3, 5))
from pelanggan p
         join transaksi t on t.id_pelanggan = p.id_pelanggan
         join header_transaksi ht on ht.id_transaksi = t.id_transaksi
         join pegawai pgw on ht.id_pegawai = pgw.id_pegawai
where t.id_transaksi = 'TRX1';

delimiter $$
create function getNewIdPembelianService(id_transaksi_p varchar(50))
    returns varchar(50)
    deterministic
begin
    declare new_id varchar(50);
    select concat(substr(lower(p.nama_pelanggan), 1, 3), t.id_transaksi, substr(lower(pgw.nama_pegawai), 1, 3),
                  p.id_pelanggan,
                  substr(rand(), 3, 5))
    into new_id
    from pelanggan p
             join transaksi t on t.id_pelanggan = p.id_pelanggan
             join header_transaksi ht on ht.id_transaksi = t.id_transaksi
             join pegawai pgw on ht.id_pegawai = pgw.id_pegawai
    where t.id_transaksi = id_transaksi_p;
    return new_id;
end$$
delimiter ;

select getNewIdPembelianService('TRX3');
