delimiter $$

create procedure InsertDataPegawai(id_pegawai varchar(50),
                                   nama_pegawai varchar(50),
                                   alamat varchar(100),
                                   username varchar(50),
                                   password varchar(50), id_nomor_pegawai varchar(50), no_telp varchar(50),
                                   id_jabatan varchar(50))
begin
    insert into pegawai
    values (id_pegawai,
            id_jabatan,
            nama_pegawai,
            alamat,
            username,
            password);
    insert into nomor_pegawai
    values (id_nomor_pegawai,
            id_pegawai, no_telp);
end $$

delimiter ;

delimiter $$
create procedure InsertDataTransaksi(id_transaksi varchar(50), id_pelanggan varchar(50), tanggal_pembelian date,
                                     total_biaya double, id_header varchar(50), id_pegawai varchar(50))
begin
    insert into transaksi
    values (id_transaksi, id_pelanggan, tanggal_pembelian, total_biaya);
    insert into header_transaksi
    values (id_header, id_transaksi, id_pegawai);
end $$
delimiter ;

# no 2
create procedure InsertJabatan(id varchar(50), nama varchar(50), gaji double)
insert into jabatan
values (id, nama, gaji);
create procedure InsertPegawai(id varchar(50), nama varchar(50), username varchar(50), password varchar(50),
                               alamat varchar(50), id_jabatan int)
insert into pegawai
values (id, nama, username, password, alamat, id_jabatan);
create procedure InsertNomorPegawai(id varchar(50), id_pegawai varchar(50), no_telp varchar(50))
insert into nomor_pegawai
values (id, id_pegawai, no_telp);
create procedure InsertPelanggan(id varchar(50), nama varchar(50))
insert into pelanggan
values (id, nama);
create procedure InsertPembelianService(id varchar(50), id_transaksi varchar(50), id_service varchar(50),
                                        id_pegawai varchar(50))
insert into pembelian_service
values (id, id_transaksi, id_pegawai, id_service);
create procedure InsertPembelianSparepart(id varchar(50), id_transaksi varchar(50), id_sparepart varchar(50),
                                          jumlah_beli int)
insert into pembelian_sparepart
values (id, id_transaksi, id_sparepart, jumlah_beli);
create procedure InsertService(id varchar(50), nama varchar(50), harga double, lama_pengerjaan int)
insert into service
values (id, nama, lama_pengerjaan, harga);
create procedure InsertSparepart(id varchar(50), nama varchar(50), harga double, stok int, jenis_sparepart varchar(50))
insert into sparepart
values (id, nama, stok, jenis_sparepart, harga);
create procedure InsertTransaksi(id varchar(50), id_pelanggan varchar(50), tgl_pembelian date, total_biaya double)
insert into transaksi
values (id, id_pelanggan, tgl_pembelian, total_biaya);
create procedure InsertHeaderTransaksi(id varchar(50), id_transaksi varchar(50), id_pegawai varchar(50))
insert into header_transaksi
values (id, id_pegawai, id_transaksi);

# no 3
create procedure DeleteJabatan(id varchar(50))
delete
from jabatan
where id_jabatan = id;
create procedure DeletePegawai(id varchar(50))
delete
from pegawai
where id_pegawai = id;
create procedure DeleteNomorPegawai(id varchar(50))
delete
from nomor_pegawai
where id_nomor = id;
create procedure DeletePelanggan(id varchar(50))
delete
from pelanggan
where id_pelanggan = id;
create procedure DeletePembelianService(id varchar(50))
delete
from pembelian_service
where id_pembelian_service = id;
create procedure DeletePembelianSparepart(id varchar(50))
delete
from pembelian_sparepart
where id_pembelian_sparepart = id;
create procedure DeleteService(id varchar(50))
delete
from service
where id_service = id;
create procedure DeleteSparepart(id varchar(50))
delete
from sparepart
where id_sparepart = id;
create procedure DeleteTransaksi(id varchar(50))
delete
from transaksi
where id_transaksi = id;
create procedure DeleteHeaderTransaksi(id varchar(50))
delete
from header_transaksi
where id_header = id;

# no 4
create procedure UpdatePegawaiAndNomor(id_pegawai_p int, nama_p varchar(50), username_p varchar(50),
                                       password_p varchar(50), alamat_p varchar(50), id_jabatan_p int,
                                       no_telp_p varchar(50))
begin
    update pegawai
    set nama_pegawai = nama_p,
        username     = username_p,
        password     = password_p,
        alamat       = alamat_p,
        id_jabatan   = id_jabatan_p
    where id_pegawai = id_pegawai_p;
    update nomor_pegawai set no_tlp = no_telp_p where id_pegawai = id_pegawai_p;
end;

# no 5
create procedure UpdateJabatan(id varchar(50), nama_p varchar(50), gaji_p double)
update jabatan
set nama_jabatan = nama_p,
    gaji         = gaji_p
where id_jabatan = id;

create procedure UpdatePegawai(id varchar(50), nama_p varchar(50), username_p varchar(50), password_p varchar(50),
                               alamat_p varchar(50), id_jabatan_p varchar(50))
update pegawai
set nama_pegawai = nama_p,
    username     = username_p,
    password     = password_p,
    alamat       = alamat_p,
    id_jabatan   = id_jabatan_p
where id_pegawai = id;

create procedure UpdateNomorPegawai(id varchar(50), id_pegawai_p varchar(50), no_telp_p varchar(50))
update nomor_pegawai
set id_pegawai = id_pegawai_p,
    no_tlp     = no_telp_p
where id_nomor = id;

create procedure UpdatePelanggan(id varchar(50), nama_p varchar(50))
update pelanggan
set nama_pelanggan = nama_p
where id_pelanggan = id;

create procedure UpdatePembelianService(id varchar(50), id_transaksi_p varchar(50), id_service_p varchar(50),
                                        id_pegawai_p varchar(50))
update pembelian_service
set id_transaksi = id_transaksi_p,
    id_pegawai   = id_pegawai_p,
    id_service   = id_service_p
where id_pembelian_service = id;

create procedure UpdatePembelianSparepart(id varchar(50), id_transaksi_p varchar(50), id_sparepart_p varchar(50),
                                          jumlah_beli_p int)
update pembelian_sparepart
set id_transaksi = id_transaksi_p,
    id_sparepart = id_sparepart_p,
    jumlah_beli  = jumlah_beli_p
where id_pembelian_sparepart = id;

create procedure UpdateService(id varchar(50), nama_p varchar(50), harga_p double, lama_pengerjaan_p int)
update service
set nama_service    = nama_p,
    harga           = harga_p,
    lama_pengerjaan = lama_pengerjaan_p
where id_service = id;

create procedure UpdateSparepart(id varchar(50), nama_p varchar(50), harga_p double, stok_p int,
                                 jenis_sparepart_p varchar(50))
update sparepart
set nama_sparepart  = nama_p,
    stok            = stok_p,
    jenis_sparepart = jenis_sparepart_p,
    harga           = harga_p
where id_sparepart = id;

create procedure UpdateTransaksi(id varchar(50), id_pelanggan_p varchar(50), tgl_pembelian_p date, total_biaya_p double)
update transaksi
set id_pelanggan      = id_pelanggan_p,
    tanggal_pembelian = tgl_pembelian_p,
    total_biaya       = total_biaya_p
where id_transaksi = id;

create procedure UpdateHeaderTransaksi(id varchar(50), id_transaksi_p varchar(50), id_pegawai_p varchar(50))
update header_transaksi
set id_transaksi = id_transaksi_p,
    id_pegawai   = id_pegawai_p
where id_header = id;

# no 6
create function PegawaiTransaksi(id_pegawai_p varchar(50), date_p date)
    returns text
    deterministic
begin
    declare id_transaksi text;
    select group_concat(res) into id_transaksi
    from (select header_transaksi.id_transaksi as res
          from header_transaksi
                   join pegawai on pegawai.id_pegawai = id_pegawai_p) as t;
    return id_transaksi;
end;


# no 7
create function GetPembelianSparepartDanServiceAsId(id_transaksi_p varchar(50))
    returns text
    deterministic
begin
    declare ids text;
    select group_concat(id)
    into ids
    from (select id_pembelian_sparepart as id
          from pembelian_sparepart
          where id_transaksi = id_transaksi_p
          union
          select id_pembelian_service as id
          from pembelian_service
          where id_transaksi = id_transaksi_p) as t;
    return ids;
end;