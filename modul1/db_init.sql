drop database if exists bengkel_mobil;

create database bengkel_mobil;

use bengkel_mobil;

create table jabatan
(
    id_jabatan   varchar(50) primary key,
    nama_jabatan varchar(50) not null,
    gaji         double      not null
);

create table pegawai
(
    id_pegawai   varchar(50) primary key,
    id_jabatan   varchar(50)  not null,
    nama_pegawai varchar(50)  not null,
    alamat       varchar(100) not null,
    username     varchar(50)  not null unique,
    password     varchar(50)  not null
);

create table nomor_pegawai
(
    id_nomor   varchar(50) primary key,
    id_pegawai varchar(50) not null,
    no_tlp     varchar(15) not null
);

create table header_transaksi
(
    id_header    varchar(50) primary key,
    id_pegawai   varchar(50) not null,
    id_transaksi varchar(50) not null
);


create table pelanggan
(
    id_pelanggan   varchar(50) primary key,
    nama_pelanggan varchar(50) not null
);

create table transaksi
(
    id_transaksi      varchar(50) primary key,
    id_pelanggan      varchar(50) not null,
    tanggal_pembelian date        not null,
    total_biaya       double      not null
);

create table pembelian_service
(
    id_pembelian_service varchar(50) primary key,
    id_transaksi         varchar(50) not null,
    id_pegawai           varchar(50) not null,
    id_service           varchar(50) not null
);

create table service
(
    id_service      varchar(50) primary key,
    nama_service    varchar(50) not null,
    lama_pengerjaan int         not null,
    harga           double      not null
);

create table pembelian_sparepart
(
    id_pembelian_sparepart varchar(50) primary key,
    id_transaksi           varchar(50) not null,
    id_sparepart           varchar(50) not null,
    jumlah_beli            int         not null
);

create table sparepart
(
    id_sparepart    varchar(50) primary key,
    nama_sparepart  varchar(50) not null,
    stok            int         not null,
    jenis_sparepart varchar(50) not null,
    harga           float       not null
);


alter table nomor_pegawai
    add constraint foreign key (id_pegawai) references pegawai (id_pegawai);
alter table pegawai
    add constraint foreign key (id_jabatan) references jabatan (id_jabatan);
alter table header_transaksi
    add constraint foreign key (id_pegawai) references pegawai (id_pegawai);
alter table header_transaksi
    add constraint foreign key (id_transaksi) references transaksi (id_transaksi);
alter table transaksi
    add constraint foreign key (id_pelanggan) references pelanggan (id_pelanggan);
alter table pembelian_service
    add constraint foreign key (id_transaksi) references transaksi (id_transaksi);
alter table pembelian_service
    add constraint foreign key (id_pegawai) references pegawai (id_pegawai);
alter table pembelian_service
    add constraint foreign key (id_service) references service (id_service);
alter table pembelian_sparepart
    add constraint foreign key (id_transaksi) references transaksi (id_transaksi);
alter table pembelian_sparepart
    add constraint foreign key (id_sparepart) references sparepart (id_sparepart);

insert into jabatan
values ('JBN0', 'manajer', 3500000),
       ('JBN1', 'kasir', 2500000),
       ('JBN2', 'montir', 3000000);
insert into pegawai
values ('PGW0', 'JBN0', 'dewi', 'jalan raya', 'dewi', 'dewi'),
       ('PGW1', 'JBN1', 'sari', 'jalan raya', 'sari', 'sari'),
       ('PGW2', 'JBN2', 'budi', 'jalan raya', 'budi', 'budi'),
       ('PGW3', 'JBN2', 'joko', 'jalan raya', 'joko', 'joko'),
       ('PGW4', 'JBN2', 'joni', 'jalan raya', 'joni', 'joni');
insert into nomor_pegawai
values ('NPI0', 'PGW0', '08123456789'),
       ('NPI1', 'PGW1', '08123456789'),
       ('NPI2', 'PGW2', '08123456789'),
       ('NPI3', 'PGW3', '08123456789'),
       ('NPI4', 'PGW4', '08123456789');
insert into pelanggan
values ('PLN0', 'sanin'),
       ('PLN1', 'santa'),
       ('PLN2', 'santo'),
       ('PLN3', 'santi'),
       ('PLN4', 'sante');
insert into transaksi
values ('TRX0', 'PLN0', '2021-01-01', 1000000),
       ('TRX1', 'PLN1', '2021-01-01', 2000000),
       ('TRX2', 'PLN2', '2021-01-01', 3000000),
       ('TRX3', 'PLN3', '2021-01-01', 4000000),
       ('TRX4', 'PLN4', '2021-01-01', 5000000);
insert into service
values ('SRV0', 'ganti oli', 1, 100000),
       ('SRV1', 'ganti ban', 2, 200000),
       ('SRV2', 'ganti kampas rem', 3, 300000),
       ('SRV3', 'ganti aki', 4, 400000),
       ('SRV4', 'ganti kabel', 5, 500000);
insert into sparepart
values ('SPT0', 'oli', 10, 'cairan', 10000),
       ('SPT1', 'ban', 20, 'ban', 20000),
       ('SPT2', 'kampas rem', 30, 'kampas', 30000),
       ('SPT3', 'aki', 40, 'aki', 40000),
       ('SPT4', 'kabel', 50, 'kabel', 50000);
insert into pembelian_service
values ('ISV0', 'TRX0', 'PGW0', 'SRV0'),
       ('ISV1', 'TRX1', 'PGW1', 'SRV1'),
       ('ISV2', 'TRX2', 'PGW2', 'SRV2'),
       ('ISV3', 'TRX3', 'PGW3', 'SRV3'),
       ('ISV4', 'TRX4', 'PGW4', 'SRV4');
insert into pembelian_sparepart
values ('ISP0', 'TRX0', 'SPT0', 1),
       ('ISP1', 'TRX1', 'SPT1', 2),
       ('ISP2', 'TRX2', 'SPT2', 3),
       ('ISP3', 'TRX3', 'SPT3', 4),
       ('ISP4', 'TRX4', 'SPT4', 5);
insert into header_transaksi
values ('HTX0', 'PGW0', 'TRX0'),
       ('HTX1', 'PGW1', 'TRX1'),
       ('HTX2', 'PGW2', 'TRX2'),
       ('HTX3', 'PGW3', 'TRX3'),
       ('HTX4', 'PGW4', 'TRX4');