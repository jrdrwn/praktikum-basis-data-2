# NO 1
select * from service;
select * from pembelian_service;
select * from transaksi;

call DeletePembelianService('ISV6');
call DeleteTransaksi('TRX7');

call InsertTransaksi('TRX7', 'PLN3', '2024-04-02', 0);
call InsertPembelianService('ISV6', 'TRX7', 'SRV1', 'PGW3');

create trigger if not exists UpdateTotalBiayaAIPembelianService
    after insert
    on pembelian_service
    for each row
begin
    declare harga_service double;
    SELECT harga into harga_service  FROM service WHERE id_service = NEW.id_service;
    UPDATE transaksi SET total_biaya = total_biaya + harga_service WHERE id_transaksi = NEW.id_transaksi;
end;

# NO 2
create trigger if not exists UpdateTotalBiayaAUPembelianService
    after update
    on pembelian_service
    for each row
begin
    declare old_harga_service double;
    declare new_harga_service double;
    SELECT harga into old_harga_service  FROM service WHERE id_service = OLD.id_service;
    SELECT harga into new_harga_service  FROM service WHERE id_service = NEW.id_service;

    UPDATE transaksi SET total_biaya = total_biaya - old_harga_service + new_harga_service WHERE id_transaksi = NEW.id_transaksi;
end;

select * from service;
select * from pembelian_service;
select * from transaksi;

call UpdatePembelianService('ISV6', 'TRX7', 'SRV1', 'PGW3');

# NO 3
create trigger if not exists UpdateTotalBiayaADPembelianService
    after delete
    on pembelian_service
    for each row
begin
    declare old_harga_service double;
    SELECT harga into old_harga_service  FROM service WHERE id_service = OLD.id_service;

    UPDATE transaksi SET total_biaya = total_biaya - old_harga_service WHERE id_transaksi = OLD.id_transaksi;
end;

call DeletePembelianService('ISV6');

# NO 4
select * from sparepart;
select * from pembelian_sparepart;
select * from transaksi;

call DeletePembelianSparepart('ISV8');
call DeleteTransaksi('TRX8');

call InsertTransaksi('TRX8', 'PLN3', '2024-04-02', 0);
call InsertPembelianSparepart('ISP8', 'TRX8', 'SPT1', 2);

create trigger if not exists UpdateTotalBiayaAIPembelianSparepart
    after insert
    on pembelian_sparepart
    for each row
begin
    declare total_harga_sparepart double;
    SELECT NEW.jumlah_beli * (SELECT harga FROM sparepart WHERE id_sparepart = NEW.id_sparepart) into total_harga_sparepart;
    UPDATE transaksi SET total_biaya = total_biaya + total_harga_sparepart WHERE id_transaksi = NEW.id_transaksi;
end;

# NO 5
create trigger if not exists UpdateTotalBiayaAUPembelianSparepart
    after update
    on pembelian_sparepart
    for each row
begin
    declare old_total_harga_sparepart double;
    declare new_total_harga_sparepart double;
    SELECT OLD.jumlah_beli * (SELECT harga FROM sparepart WHERE id_sparepart = OLD.id_sparepart) into old_total_harga_sparepart;
    SELECT NEW.jumlah_beli * (SELECT harga FROM sparepart WHERE id_sparepart = NEW.id_sparepart) into new_total_harga_sparepart;

    UPDATE transaksi SET total_biaya = total_biaya - old_total_harga_sparepart + new_total_harga_sparepart WHERE id_transaksi = NEW.id_transaksi;
end;

call UpdatePembelianSparepart('ISP8', 'TRX8', 'SPT1', 2);
select * from transaksi;

# NO 6
create trigger UpdateTotalBiayaADPembelianSparepart
    after delete
    on pembelian_sparepart
    for each row
begin
    declare old_total_harga_sparepart double;
    SELECT OLD.jumlah_beli * (SELECT harga FROM sparepart WHERE id_sparepart = OLD.id_sparepart) into old_total_harga_sparepart;

    UPDATE transaksi SET total_biaya = total_biaya - old_total_harga_sparepart WHERE id_transaksi = OLD.id_transaksi;
end;
select * from pembelian_sparepart;
select * from transaksi;

call DeletePembelianSparepart('ISP8');

# NO 7
select * from sparepart;
select * from pembelian_sparepart;

create trigger UpdateJumlahStokAIPembelianSparepart
    after insert
    on pembelian_sparepart
    for each row
begin
    update sparepart set stok = stok - NEW.jumlah_beli where id_sparepart = NEW.id_sparepart;
end;

call InsertPembelianSparepart('ISP8', 'TRX8', 'SPT1', 9);

# NO 8
create trigger UpdateJumlahStokAUPembelianSparepart
    after update
    on pembelian_sparepart
    for each row
begin
    if(OLD.id_sparepart != NEW.id_sparepart) then
        update sparepart set stok = stok + OLD.jumlah_beli where id_sparepart = OLD.id_sparepart;
        update sparepart set stok = stok - NEW.jumlah_beli where id_sparepart = NEW.id_sparepart;
    else
        update sparepart set stok = stok + OLD.jumlah_beli - NEW.jumlah_beli where id_sparepart = NEW.id_sparepart;
    end if;
end;

call UpdatePembelianSparepart('ISP8', 'TRX8', 'SPT1', 20);

select * from sparepart;

# NO 9
create trigger UpdateJumlahStokADPembelianSparepart
    after delete
    on pembelian_sparepart
    for each row
begin
    update sparepart set stok = stok + OLD.jumlah_beli where id_sparepart = OLD.id_sparepart;
end;

call DeletePembelianSparepart('ISP8');

# BONUS
create trigger raise_error_when_stok_less_than_zero_BI
    before insert
    on pembelian_sparepart
    for each row
begin
    declare stok_sparepart int;
    SELECT stok into stok_sparepart  FROM sparepart WHERE id_sparepart = NEW.id_sparepart;
    if stok_sparepart - NEW.jumlah_beli < 0 then
        signal sqlstate '45000' set message_text = 'Stok tidak mencukupi';
    end if;
end;

create trigger raise_error_when_stok_less_than_zero_BU
    before update
    on pembelian_sparepart
    for each row
begin
    declare stok_sparepart int;
    SELECT stok into stok_sparepart  FROM sparepart WHERE id_sparepart = NEW.id_sparepart;
    if stok_sparepart - NEW.jumlah_beli < 0 then
        signal sqlstate '45000' set message_text = 'Stok tidak mencukupi';
    end if;
end;
