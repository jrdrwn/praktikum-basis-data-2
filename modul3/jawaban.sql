# no 1
select * from sparepart;

# step 1
call InsertSparepart('SPT5', 'Dunlop', 100000, 10, 'ban');

select * from transaksi;
select * from pelanggan;

# step 2
call InsertTransaksi('TRX5', 'PLN4', '2024-03-27', 100000);
call InsertTransaksi('TRX6', 'PLN3', '2024-03-27', 100000);

select * from pembelian_sparepart;

# step 3
call InsertPembelianSparepart('ISP6', 'TRX5', 'SPT5', 1);
call InsertPembelianSparepart('ISP7', 'TRX6', 'SPT5', 1);

select * from header_transaksi;

# step 4
call InsertHeaderTransaksi('HTX5', 'TRX5','PGW4');
call InsertHeaderTransaksi('HTX6', 'TRX6','PGW3');

# step 5
select s.id_sparepart, s.nama_sparepart, s.jenis_sparepart, ps.id_transaksi, ps.jumlah_beli, t.id_pelanggan from sparepart s join pembelian_sparepart ps on s.id_sparepart = ps.id_sparepart join transaksi t on t.id_transaksi = ps.id_transaksi where s.nama_sparepart = 'Dunlop';

# step 6
create view ban_dunlop as select s.id_sparepart, s.nama_sparepart, s.jenis_sparepart, ps.id_transaksi, ps.jumlah_beli, t.id_pelanggan from sparepart s join pembelian_sparepart ps on s.id_sparepart = ps.id_sparepart join transaksi t on t.id_transaksi = ps.id_transaksi where s.nama_sparepart = 'Dunlop';

# step 7 (testing)
select * from ban_dunlop;

# no 2
select * from jabatan where nama_jabatan = 'montir';
select id_pegawai from pegawai p join jabatan j on p.id_jabatan = j.id_jabatan where j.nama_jabatan = 'montir';
select p.id_pegawai from header_transaksi join pegawai p on p.id_pegawai = header_transaksi.id_pegawai join jabatan j on p.id_jabatan = j.id_jabatan where j.nama_jabatan = 'montir';

select  * from service;
select  * from pembelian_service;

select p.id_pegawai, harga from service s join pembelian_service ps on s.id_service = ps.id_service join header_transaksi ht on ht.id_transaksi = ps.id_transaksi join pegawai p on p.id_pegawai = ht.id_pegawai join jabatan j on p.id_jabatan = j.id_jabatan where j.nama_jabatan = 'montir';
select p.id_pegawai, sum(harga) as pemasukan from service s join pembelian_service ps on s.id_service = ps.id_service join header_transaksi ht on ht.id_transaksi = ps.id_transaksi join pegawai p on p.id_pegawai = ht.id_pegawai join jabatan j on p.id_jabatan = j.id_jabatan where j.nama_jabatan = 'montir' group by p.id_pegawai;

create view pemasukan_pegawai_service as select p.id_pegawai, sum(harga) as pemasukan from service s join pembelian_service ps on s.id_service = ps.id_service join header_transaksi ht on ht.id_transaksi = ps.id_transaksi join pegawai p on p.id_pegawai = ht.id_pegawai join jabatan j on p.id_jabatan = j.id_jabatan where j.nama_jabatan = 'montir' group by p.id_pegawai;

select * from pemasukan_pegawai_service;

# no 3
select p.id_pegawai, nama_pegawai, nama_jabatan, no_tlp from pegawai p join jabatan j on p.id_jabatan = j.id_jabatan join nomor_pegawai n on p.id_pegawai = n.id_pegawai;

create view daftar_pegawai as select p.id_pegawai, nama_pegawai, nama_jabatan, no_tlp from pegawai p join jabatan j on p.id_jabatan = j.id_jabatan join nomor_pegawai n on p.id_pegawai = n.id_pegawai;

select * from daftar_pegawai;

# no 4
# select nama_pelanggan from pelanggan;
# select nama_pegawai from pegawai;
# select * from pembelian_sparepart;
# select * from pembelian_service;
# select * from transaksi;
#
# select nama_pelanggan, pgw.nama_pegawai, jumlah_beli as jumlah_sparepart_dibeli, id_service as jumlah_service_dibeli, tanggal_pembelian from transaksi t join pelanggan p on t.id_pelanggan = p.id_pelanggan join pembelian_sparepart ps on t.id_transaksi = ps.id_transaksi join pembelian_service psr on t.id_transaksi = psr.id_transaksi join pegawai pgw on psr.id_pegawai = pgw.id_pegawai;
# select nama_pelanggan, pgw.nama_pegawai, sum(jumlah_beli) as jumlah_sparepart_dibeli, count(id_service) as jumlah_service_dibeli, tanggal_pembelian from transaksi t join pelanggan p on t.id_pelanggan = p.id_pelanggan join pembelian_sparepart ps on t.id_transaksi = ps.id_transaksi join pembelian_service psr on t.id_transaksi = psr.id_transaksi join pegawai pgw on psr.id_pegawai = pgw.id_pegawai group by p.id_pelanggan, pgw.id_pegawai, t.id_transaksi, tanggal_pembelian;
#
#
# select * from pembelian_sparepart pst join transaksi t on pst.id_transaksi = t.id_transaksi join pelanggan p on t.id_pelanggan = p.id_pelanggan join header_transaksi ht on t.id_transaksi = ht.id_transaksi join pegawai pgw on ht.id_pegawai = pgw.id_pegawai;
#
# select  * from header_transaksi;
CREATE VIEW detail_transaksi AS
SELECT pelanggan.nama_pelanggan, pegawai.nama_pegawai, SUM(pembelian_sparepart.jumlah_beli), COUNT(pembelian_service.id_service), transaksi.tanggal_pembelian
FROM transaksi
INNER JOIN pelanggan ON transaksi.id_pelanggan = pelanggan.id_pelanggan
INNER JOIN pembelian_service ON transaksi.id_transaksi = pembelian_service.id_transaksi
INNER JOIN pegawai ON pembelian_service.id_pegawai = pegawai.id_pegawai
INNER JOIN pembelian_sparepart ON transaksi.id_transaksi = pembelian_sparepart.id_transaksi
GROUP BY (pelanggan.id_pelanggan)
