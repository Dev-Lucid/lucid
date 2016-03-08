
-- Loaded, downloading sources.
-- Using countries cache.
-- Using regions cache.
-- Countries parsed.
-- regions parsed.
DROP TABLE IF EXISTS regions;
DROP TABLE IF EXISTS countries;

CREATE TABLE IF NOT EXISTS countries (
    country_id char(2) NOT NULL primary key,
    alpha_3 char(3) NOT NULL UNIQUE,
    name varchar(255) NOT NULL,
    common_name varchar(255) NOT NULL,
    official_name varchar(255) NOT NULL
);


 CREATE TABLE IF NOT EXISTS regions (
    region_id varchar(7) NOT NULL primary key,
    country_id char(2) NOT NULL,
    abbreviation varchar(4) NOT NULL,
    name varchar(255) NOT NULL,
    type varchar(50) NOT NULL,
    parent varchar(7),
    is_parent bool default false,
    FOREIGN KEY (country_id) REFERENCES countries(country_id)
);


INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('AF', 'AFG', 'Afghanistan', '', 'Islamic Republic of Afghanistan');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('AF-BDS', 'AF', 'BDS', 'Badakhshān', 'Province',NULL),
('AF-BDG', 'AF', 'BDG', 'Bādghīs', 'Province',NULL),
('AF-BGL', 'AF', 'BGL', 'Baghlān', 'Province',NULL),
('AF-BAL', 'AF', 'BAL', 'Balkh', 'Province',NULL),
('AF-BAM', 'AF', 'BAM', 'Bāmyān', 'Province',NULL),
('AF-DAY', 'AF', 'DAY', 'Dāykundī', 'Province',NULL),
('AF-FRA', 'AF', 'FRA', 'Farāh', 'Province',NULL),
('AF-FYB', 'AF', 'FYB', 'Fāryāb', 'Province',NULL),
('AF-GHA', 'AF', 'GHA', 'Ghaznī', 'Province',NULL),
('AF-GHO', 'AF', 'GHO', 'Ghōr', 'Province',NULL),
('AF-HEL', 'AF', 'HEL', 'Helmand', 'Province',NULL),
('AF-HER', 'AF', 'HER', 'Herāt', 'Province',NULL),
('AF-JOW', 'AF', 'JOW', 'Jowzjān', 'Province',NULL),
('AF-KAB', 'AF', 'KAB', 'Kābul', 'Province',NULL),
('AF-KAN', 'AF', 'KAN', 'Kandahār', 'Province',NULL),
('AF-KAP', 'AF', 'KAP', 'Kāpīsā', 'Province',NULL),
('AF-KHO', 'AF', 'KHO', 'Khōst', 'Province',NULL),
('AF-KNR', 'AF', 'KNR', 'Kunar', 'Province',NULL),
('AF-KDZ', 'AF', 'KDZ', 'Kunduz', 'Province',NULL),
('AF-LAG', 'AF', 'LAG', 'Laghmān', 'Province',NULL),
('AF-LOG', 'AF', 'LOG', 'Lōgar', 'Province',NULL),
('AF-NAN', 'AF', 'NAN', 'Nangarhār', 'Province',NULL),
('AF-NIM', 'AF', 'NIM', 'Nīmrōz', 'Province',NULL),
('AF-NUR', 'AF', 'NUR', 'Nūristān', 'Province',NULL),
('AF-URU', 'AF', 'URU', 'Uruzgān', 'Province',NULL),
('AF-PIA', 'AF', 'PIA', 'Paktiyā', 'Province',NULL),
('AF-PKA', 'AF', 'PKA', 'Paktīkā', 'Province',NULL),
('AF-PAN', 'AF', 'PAN', 'Panjshayr', 'Province',NULL),
('AF-PAR', 'AF', 'PAR', 'Parwān', 'Province',NULL),
('AF-SAM', 'AF', 'SAM', 'Samangān', 'Province',NULL),
('AF-SAR', 'AF', 'SAR', 'Sar-e Pul', 'Province',NULL),
('AF-TAK', 'AF', 'TAK', 'Takhār', 'Province',NULL),
('AF-WAR', 'AF', 'WAR', 'Wardak', 'Province',NULL),
('AF-ZAB', 'AF', 'ZAB', 'Zābul', 'Province',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('AX', 'ALA', 'Åland Islands', '', '');

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('AL', 'ALB', 'Albania', '', 'Republic of Albania');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('AL-01', 'AL', '01', 'Berat', 'County',NULL),
('AL-09', 'AL', '09', 'Dibër', 'County',NULL),
('AL-02', 'AL', '02', 'Durrës', 'County',NULL),
('AL-03', 'AL', '03', 'Elbasan', 'County',NULL),
('AL-04', 'AL', '04', 'Fier', 'County',NULL),
('AL-05', 'AL', '05', 'Gjirokastër', 'County',NULL),
('AL-06', 'AL', '06', 'Korçë', 'County',NULL),
('AL-07', 'AL', '07', 'Kukës', 'County',NULL),
('AL-08', 'AL', '08', 'Lezhë', 'County',NULL),
('AL-10', 'AL', '10', 'Shkodër', 'County',NULL),
('AL-11', 'AL', '11', 'Tiranë', 'County',NULL),
('AL-12', 'AL', '12', 'Vlorë', 'County',NULL),
('AL-BR', 'AL', 'BR', 'Berat', 'District','AL-01'),
('AL-BU', 'AL', 'BU', 'Bulqizë', 'District','AL-09'),
('AL-DL', 'AL', 'DL', 'Delvinë', 'District','AL-12'),
('AL-DV', 'AL', 'DV', 'Devoll', 'District','AL-06'),
('AL-DI', 'AL', 'DI', 'Dibër', 'District','AL-09'),
('AL-DR', 'AL', 'DR', 'Durrës', 'District','AL-02'),
('AL-EL', 'AL', 'EL', 'Elbasan', 'District','AL-03'),
('AL-FR', 'AL', 'FR', 'Fier', 'District','AL-04'),
('AL-GR', 'AL', 'GR', 'Gramsh', 'District','AL-03'),
('AL-GJ', 'AL', 'GJ', 'Gjirokastër', 'District','AL-05'),
('AL-HA', 'AL', 'HA', 'Has', 'District','AL-07'),
('AL-KA', 'AL', 'KA', 'Kavajë', 'District','AL-11'),
('AL-ER', 'AL', 'ER', 'Kolonjë', 'District','AL-06'),
('AL-KO', 'AL', 'KO', 'Korçë', 'District','AL-06'),
('AL-KR', 'AL', 'KR', 'Krujë', 'District','AL-02'),
('AL-KC', 'AL', 'KC', 'Kuçovë', 'District','AL-01'),
('AL-KU', 'AL', 'KU', 'Kukës', 'District','AL-07'),
('AL-KB', 'AL', 'KB', 'Kurbin', 'District','AL-08'),
('AL-LE', 'AL', 'LE', 'Lezhë', 'District','AL-08'),
('AL-LB', 'AL', 'LB', 'Librazhd', 'District','AL-03'),
('AL-LU', 'AL', 'LU', 'Lushnjë', 'District','AL-04'),
('AL-MM', 'AL', 'MM', 'Malësi e Madhe', 'District','AL-10'),
('AL-MK', 'AL', 'MK', 'Mallakastër', 'District','AL-04'),
('AL-MT', 'AL', 'MT', 'Mat', 'District','AL-09'),
('AL-MR', 'AL', 'MR', 'Mirditë', 'District','AL-08'),
('AL-PQ', 'AL', 'PQ', 'Peqin', 'District','AL-03'),
('AL-PR', 'AL', 'PR', 'Përmet', 'District','AL-05'),
('AL-PG', 'AL', 'PG', 'Pogradec', 'District','AL-06'),
('AL-PU', 'AL', 'PU', 'Pukë', 'District','AL-10'),
('AL-SR', 'AL', 'SR', 'Sarandë', 'District','AL-12'),
('AL-SK', 'AL', 'SK', 'Skrapar', 'District','AL-01'),
('AL-SH', 'AL', 'SH', 'Shkodër', 'District','AL-10'),
('AL-TE', 'AL', 'TE', 'Tepelenë', 'District','AL-05'),
('AL-TR', 'AL', 'TR', 'Tiranë', 'District','AL-11'),
('AL-TP', 'AL', 'TP', 'Tropojë', 'District','AL-07'),
('AL-VL', 'AL', 'VL', 'Vlorë', 'District','AL-12');

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('DZ', 'DZA', 'Algeria', '', 'People''s Democratic Republic of Algeria');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('DZ-01', 'DZ', '01', 'Adrar', 'Province',NULL),
('DZ-44', 'DZ', '44', 'Aïn Defla', 'Province',NULL),
('DZ-46', 'DZ', '46', 'Aïn Témouchent', 'Province',NULL),
('DZ-16', 'DZ', '16', 'Alger', 'Province',NULL),
('DZ-23', 'DZ', '23', 'Annaba', 'Province',NULL),
('DZ-05', 'DZ', '05', 'Batna', 'Province',NULL),
('DZ-08', 'DZ', '08', 'Béchar', 'Province',NULL),
('DZ-06', 'DZ', '06', 'Béjaïa', 'Province',NULL),
('DZ-07', 'DZ', '07', 'Biskra', 'Province',NULL),
('DZ-09', 'DZ', '09', 'Blida', 'Province',NULL),
('DZ-34', 'DZ', '34', 'Bordj Bou Arréridj', 'Province',NULL),
('DZ-10', 'DZ', '10', 'Bouira', 'Province',NULL),
('DZ-35', 'DZ', '35', 'Boumerdès', 'Province',NULL),
('DZ-02', 'DZ', '02', 'Chlef', 'Province',NULL),
('DZ-25', 'DZ', '25', 'Constantine', 'Province',NULL),
('DZ-17', 'DZ', '17', 'Djelfa', 'Province',NULL),
('DZ-32', 'DZ', '32', 'El Bayadh', 'Province',NULL),
('DZ-39', 'DZ', '39', 'El Oued', 'Province',NULL),
('DZ-36', 'DZ', '36', 'El Tarf', 'Province',NULL),
('DZ-47', 'DZ', '47', 'Ghardaïa', 'Province',NULL),
('DZ-24', 'DZ', '24', 'Guelma', 'Province',NULL),
('DZ-33', 'DZ', '33', 'Illizi', 'Province',NULL),
('DZ-18', 'DZ', '18', 'Jijel', 'Province',NULL),
('DZ-40', 'DZ', '40', 'Khenchela', 'Province',NULL),
('DZ-03', 'DZ', '03', 'Laghouat', 'Province',NULL),
('DZ-29', 'DZ', '29', 'Mascara', 'Province',NULL),
('DZ-26', 'DZ', '26', 'Médéa', 'Province',NULL),
('DZ-43', 'DZ', '43', 'Mila', 'Province',NULL),
('DZ-27', 'DZ', '27', 'Mostaganem', 'Province',NULL),
('DZ-28', 'DZ', '28', 'Msila', 'Province',NULL),
('DZ-45', 'DZ', '45', 'Naama', 'Province',NULL),
('DZ-31', 'DZ', '31', 'Oran', 'Province',NULL),
('DZ-30', 'DZ', '30', 'Ouargla', 'Province',NULL),
('DZ-04', 'DZ', '04', 'Oum el Bouaghi', 'Province',NULL),
('DZ-48', 'DZ', '48', 'Relizane', 'Province',NULL),
('DZ-20', 'DZ', '20', 'Saïda', 'Province',NULL),
('DZ-19', 'DZ', '19', 'Sétif', 'Province',NULL),
('DZ-22', 'DZ', '22', 'Sidi Bel Abbès', 'Province',NULL),
('DZ-21', 'DZ', '21', 'Skikda', 'Province',NULL),
('DZ-41', 'DZ', '41', 'Souk Ahras', 'Province',NULL),
('DZ-11', 'DZ', '11', 'Tamanghasset', 'Province',NULL),
('DZ-12', 'DZ', '12', 'Tébessa', 'Province',NULL),
('DZ-14', 'DZ', '14', 'Tiaret', 'Province',NULL),
('DZ-37', 'DZ', '37', 'Tindouf', 'Province',NULL),
('DZ-42', 'DZ', '42', 'Tipaza', 'Province',NULL),
('DZ-38', 'DZ', '38', 'Tissemsilt', 'Province',NULL),
('DZ-15', 'DZ', '15', 'Tizi Ouzou', 'Province',NULL),
('DZ-13', 'DZ', '13', 'Tlemcen', 'Province',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('AS', 'ASM', 'American Samoa', '', '');

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('AD', 'AND', 'Andorra', '', 'Principality of Andorra');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('AD-07', 'AD', '07', 'Andorra la Vella', 'Parish',NULL),
('AD-02', 'AD', '02', 'Canillo', 'Parish',NULL),
('AD-03', 'AD', '03', 'Encamp', 'Parish',NULL),
('AD-08', 'AD', '08', 'Escaldes-Engordany', 'Parish',NULL),
('AD-04', 'AD', '04', 'La Massana', 'Parish',NULL),
('AD-05', 'AD', '05', 'Ordino', 'Parish',NULL),
('AD-06', 'AD', '06', 'Sant Julià de Lòria', 'Parish',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('AO', 'AGO', 'Angola', '', 'Republic of Angola');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('AO-BGO', 'AO', 'BGO', 'Bengo', 'Province',NULL),
('AO-BGU', 'AO', 'BGU', 'Benguela', 'Province',NULL),
('AO-BIE', 'AO', 'BIE', 'Bié', 'Province',NULL),
('AO-CAB', 'AO', 'CAB', 'Cabinda', 'Province',NULL),
('AO-CCU', 'AO', 'CCU', 'Cuando-Cubango', 'Province',NULL),
('AO-CNO', 'AO', 'CNO', 'Cuanza Norte', 'Province',NULL),
('AO-CUS', 'AO', 'CUS', 'Cuanza Sul', 'Province',NULL),
('AO-CNN', 'AO', 'CNN', 'Cunene', 'Province',NULL),
('AO-HUA', 'AO', 'HUA', 'Huambo', 'Province',NULL),
('AO-HUI', 'AO', 'HUI', 'Huíla', 'Province',NULL),
('AO-LUA', 'AO', 'LUA', 'Luanda', 'Province',NULL),
('AO-LNO', 'AO', 'LNO', 'Lunda Norte', 'Province',NULL),
('AO-LSU', 'AO', 'LSU', 'Lunda Sul', 'Province',NULL),
('AO-MAL', 'AO', 'MAL', 'Malange', 'Province',NULL),
('AO-MOX', 'AO', 'MOX', 'Moxico', 'Province',NULL),
('AO-NAM', 'AO', 'NAM', 'Namibe', 'Province',NULL),
('AO-UIG', 'AO', 'UIG', 'Uíge', 'Province',NULL),
('AO-ZAI', 'AO', 'ZAI', 'Zaire', 'Province',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('AI', 'AIA', 'Anguilla', '', '');

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('AQ', 'ATA', 'Antarctica', '', '');

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('AG', 'ATG', 'Antigua and Barbuda', '', '');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('AG-03', 'AG', '03', 'Saint George', 'Parish',NULL),
('AG-04', 'AG', '04', 'Saint John', 'Parish',NULL),
('AG-05', 'AG', '05', 'Saint Mary', 'Parish',NULL),
('AG-06', 'AG', '06', 'Saint Paul', 'Parish',NULL),
('AG-07', 'AG', '07', 'Saint Peter', 'Parish',NULL),
('AG-08', 'AG', '08', 'Saint Philip', 'Parish',NULL),
('AG-10', 'AG', '10', 'Barbuda', 'Dependency',NULL),
('AG-11', 'AG', '11', 'Redonda', 'Dependency',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('AR', 'ARG', 'Argentina', '', 'Argentine Republic');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('AR-C', 'AR', 'C', 'Ciudad Autónoma de Buenos Aires', 'City',NULL),
('AR-B', 'AR', 'B', 'Buenos Aires', 'Province',NULL),
('AR-K', 'AR', 'K', 'Catamarca', 'Province',NULL),
('AR-X', 'AR', 'X', 'Cordoba', 'Province',NULL),
('AR-W', 'AR', 'W', 'Corrientes', 'Province',NULL),
('AR-H', 'AR', 'H', 'Chaco', 'Province',NULL),
('AR-U', 'AR', 'U', 'Chubut', 'Province',NULL),
('AR-E', 'AR', 'E', 'Entre Rios', 'Province',NULL),
('AR-P', 'AR', 'P', 'Formosa', 'Province',NULL),
('AR-Y', 'AR', 'Y', 'Jujuy', 'Province',NULL),
('AR-L', 'AR', 'L', 'La Pampa', 'Province',NULL),
('AR-M', 'AR', 'M', 'Mendoza', 'Province',NULL),
('AR-N', 'AR', 'N', 'Misiones', 'Province',NULL),
('AR-Q', 'AR', 'Q', 'Neuquen', 'Province',NULL),
('AR-R', 'AR', 'R', 'Rio Negro', 'Province',NULL),
('AR-A', 'AR', 'A', 'Salta', 'Province',NULL),
('AR-J', 'AR', 'J', 'San Juan', 'Province',NULL),
('AR-D', 'AR', 'D', 'San Luis', 'Province',NULL),
('AR-Z', 'AR', 'Z', 'Santa Cruz', 'Province',NULL),
('AR-S', 'AR', 'S', 'Santa Fe', 'Province',NULL),
('AR-G', 'AR', 'G', 'Santiago del Estero', 'Province',NULL),
('AR-V', 'AR', 'V', 'Tierra del Fuego', 'Province',NULL),
('AR-T', 'AR', 'T', 'Tucuman', 'Province',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('AM', 'ARM', 'Armenia', '', 'Republic of Armenia');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('AM-ER', 'AM', 'ER', 'Erevan', 'Province',NULL),
('AM-AG', 'AM', 'AG', 'Aragacotn', 'Province',NULL),
('AM-AR', 'AM', 'AR', 'Ararat', 'Province',NULL),
('AM-AV', 'AM', 'AV', 'Armavir', 'Province',NULL),
('AM-GR', 'AM', 'GR', 'Gegarkunik''', 'Province',NULL),
('AM-KT', 'AM', 'KT', 'Kotayk''', 'Province',NULL),
('AM-LO', 'AM', 'LO', 'Lory', 'Province',NULL),
('AM-SH', 'AM', 'SH', 'Sirak', 'Province',NULL),
('AM-SU', 'AM', 'SU', 'Syunik''', 'Province',NULL),
('AM-TV', 'AM', 'TV', 'Tavus', 'Province',NULL),
('AM-VD', 'AM', 'VD', 'Vayoc Jor', 'Province',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('AW', 'ABW', 'Aruba', '', '');

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('AU', 'AUS', 'Australia', '', '');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('AU-NSW', 'AU', 'NSW', 'New South Wales', 'State',NULL),
('AU-QLD', 'AU', 'QLD', 'Queensland', 'State',NULL),
('AU-SA', 'AU', 'SA', 'South Australia', 'State',NULL),
('AU-TAS', 'AU', 'TAS', 'Tasmania', 'State',NULL),
('AU-VIC', 'AU', 'VIC', 'Victoria', 'State',NULL),
('AU-WA', 'AU', 'WA', 'Western Australia', 'State',NULL),
('AU-ACT', 'AU', 'ACT', 'Australian Capital Territory', 'Territory',NULL),
('AU-NT', 'AU', 'NT', 'Northern Territory', 'Territory',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('AT', 'AUT', 'Austria', '', 'Republic of Austria');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('AT-1', 'AT', '1', 'Burgenland', 'State',NULL),
('AT-2', 'AT', '2', 'Kärnten', 'State',NULL),
('AT-3', 'AT', '3', 'Niederösterreich', 'State',NULL),
('AT-4', 'AT', '4', 'Oberösterreich', 'State',NULL),
('AT-5', 'AT', '5', 'Salzburg', 'State',NULL),
('AT-6', 'AT', '6', 'Steiermark', 'State',NULL),
('AT-7', 'AT', '7', 'Tirol', 'State',NULL),
('AT-8', 'AT', '8', 'Vorarlberg', 'State',NULL),
('AT-9', 'AT', '9', 'Wien', 'State',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('AZ', 'AZE', 'Azerbaijan', '', 'Republic of Azerbaijan');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('AZ-NX', 'AZ', 'NX', 'Naxçıvan', 'Autonomous republic',NULL),
('AZ-BA', 'AZ', 'BA', 'Bakı', 'Municipality',NULL),
('AZ-GA', 'AZ', 'GA', 'Gəncə', 'Municipality',NULL),
('AZ-XA', 'AZ', 'XA', 'Xankəndi', 'Municipality',NULL),
('AZ-LA', 'AZ', 'LA', 'Lənkəran', 'Municipality',NULL),
('AZ-MI', 'AZ', 'MI', 'Mingəçevir', 'Municipality',NULL),
('AZ-NA', 'AZ', 'NA', 'Naftalan', 'Municipality',NULL),
('AZ-NV', 'AZ', 'NV', 'Naxçıvan', 'Municipality','AZ-NX'),
('AZ-SM', 'AZ', 'SM', 'Sumqayıt', 'Municipality',NULL),
('AZ-SA', 'AZ', 'SA', 'Şəki', 'Municipality',NULL),
('AZ-SR', 'AZ', 'SR', 'Şirvan', 'Municipality',NULL),
('AZ-YE', 'AZ', 'YE', 'Yevlax', 'Municipality',NULL),
('AZ-ABS', 'AZ', 'ABS', 'Abşeron', 'Rayon',NULL),
('AZ-AGC', 'AZ', 'AGC', 'Ağcabədi', 'Rayon',NULL),
('AZ-AGM', 'AZ', 'AGM', 'Ağdam', 'Rayon',NULL),
('AZ-AGS', 'AZ', 'AGS', 'Ağdaş', 'Rayon',NULL),
('AZ-AGA', 'AZ', 'AGA', 'Ağstafa', 'Rayon',NULL),
('AZ-AGU', 'AZ', 'AGU', 'Ağsu', 'Rayon',NULL),
('AZ-AST', 'AZ', 'AST', 'Astara', 'Rayon',NULL),
('AZ-BAB', 'AZ', 'BAB', 'Babək', 'Rayon','AZ-NX'),
('AZ-BAL', 'AZ', 'BAL', 'Balakən', 'Rayon',NULL),
('AZ-BEY', 'AZ', 'BEY', 'Beyləqan', 'Rayon',NULL),
('AZ-BAR', 'AZ', 'BAR', 'Bərdə', 'Rayon',NULL),
('AZ-BIL', 'AZ', 'BIL', 'Biləsuvar', 'Rayon',NULL),
('AZ-CAB', 'AZ', 'CAB', 'Cəbrayıl', 'Rayon',NULL),
('AZ-CAL', 'AZ', 'CAL', 'Cəlilabab', 'Rayon',NULL),
('AZ-CUL', 'AZ', 'CUL', 'Culfa', 'Rayon','AZ-NX'),
('AZ-DAS', 'AZ', 'DAS', 'Daşkəsən', 'Rayon',NULL),
('AZ-FUZ', 'AZ', 'FUZ', 'Füzuli', 'Rayon',NULL),
('AZ-GAD', 'AZ', 'GAD', 'Gədəbəy', 'Rayon',NULL),
('AZ-GOR', 'AZ', 'GOR', 'Goranboy', 'Rayon',NULL),
('AZ-GOY', 'AZ', 'GOY', 'Göyçay', 'Rayon',NULL),
('AZ-GYG', 'AZ', 'GYG', 'Göygöl', 'Rayon',NULL),
('AZ-HAC', 'AZ', 'HAC', 'Hacıqabul', 'Rayon',NULL),
('AZ-XAC', 'AZ', 'XAC', 'Xaçmaz', 'Rayon',NULL),
('AZ-XIZ', 'AZ', 'XIZ', 'Xızı', 'Rayon',NULL),
('AZ-XCI', 'AZ', 'XCI', 'Xocalı', 'Rayon',NULL),
('AZ-XVD', 'AZ', 'XVD', 'Xocavənd', 'Rayon',NULL),
('AZ-IMI', 'AZ', 'IMI', 'İmişli', 'Rayon',NULL),
('AZ-ISM', 'AZ', 'ISM', 'İsmayıllı', 'Rayon',NULL),
('AZ-KAL', 'AZ', 'KAL', 'Kəlbəcər', 'Rayon',NULL),
('AZ-KAN', 'AZ', 'KAN', 'Kǝngǝrli', 'Rayon','AZ-NX'),
('AZ-KUR', 'AZ', 'KUR', 'Kürdəmir', 'Rayon',NULL),
('AZ-QAX', 'AZ', 'QAX', 'Qax', 'Rayon',NULL),
('AZ-QAZ', 'AZ', 'QAZ', 'Qazax', 'Rayon',NULL),
('AZ-QOB', 'AZ', 'QOB', 'Qobustan', 'Rayon',NULL),
('AZ-QBA', 'AZ', 'QBA', 'Quba', 'Rayon',NULL),
('AZ-QBI', 'AZ', 'QBI', 'Qubadlı', 'Rayon',NULL),
('AZ-QUS', 'AZ', 'QUS', 'Qusar', 'Rayon',NULL),
('AZ-LAC', 'AZ', 'LAC', 'Laçın', 'Rayon',NULL),
('AZ-LER', 'AZ', 'LER', 'Lerik', 'Rayon',NULL),
('AZ-LAN', 'AZ', 'LAN', 'Lənkəran', 'Rayon',NULL),
('AZ-MAS', 'AZ', 'MAS', 'Masallı', 'Rayon',NULL),
('AZ-NEF', 'AZ', 'NEF', 'Neftçala', 'Rayon',NULL),
('AZ-OGU', 'AZ', 'OGU', 'Oğuz', 'Rayon',NULL),
('AZ-ORD', 'AZ', 'ORD', 'Ordubad', 'Rayon','AZ-NX'),
('AZ-QAB', 'AZ', 'QAB', 'Qəbələ', 'Rayon',NULL),
('AZ-SAT', 'AZ', 'SAT', 'Saatlı', 'Rayon',NULL),
('AZ-SAB', 'AZ', 'SAB', 'Sabirabad', 'Rayon',NULL),
('AZ-SAL', 'AZ', 'SAL', 'Salyan', 'Rayon',NULL),
('AZ-SMX', 'AZ', 'SMX', 'Samux', 'Rayon',NULL),
('AZ-SAD', 'AZ', 'SAD', 'Sədərək', 'Rayon','AZ-NX'),
('AZ-SIY', 'AZ', 'SIY', 'Siyəzən', 'Rayon',NULL),
('AZ-SBN', 'AZ', 'SBN', 'Şabran', 'Rayon',NULL),
('AZ-SAH', 'AZ', 'SAH', 'Şahbuz', 'Rayon','AZ-NX'),
('AZ-SMI', 'AZ', 'SMI', 'Şamaxı', 'Rayon',NULL),
('AZ-SAK', 'AZ', 'SAK', 'Şəki', 'Rayon',NULL),
('AZ-SKR', 'AZ', 'SKR', 'Şəmkir', 'Rayon',NULL),
('AZ-SAR', 'AZ', 'SAR', 'Şərur', 'Rayon','AZ-NX'),
('AZ-SUS', 'AZ', 'SUS', 'Şuşa', 'Rayon',NULL),
('AZ-TAR', 'AZ', 'TAR', 'Tərtər', 'Rayon',NULL),
('AZ-TOV', 'AZ', 'TOV', 'Tovuz', 'Rayon',NULL),
('AZ-UCA', 'AZ', 'UCA', 'Ucar', 'Rayon',NULL),
('AZ-YAR', 'AZ', 'YAR', 'Yardımlı', 'Rayon',NULL),
('AZ-YEV', 'AZ', 'YEV', 'Yevlax', 'Rayon',NULL),
('AZ-ZAQ', 'AZ', 'ZAQ', 'Zaqatala', 'Rayon',NULL),
('AZ-ZAN', 'AZ', 'ZAN', 'Zəngilan', 'Rayon',NULL),
('AZ-ZAR', 'AZ', 'ZAR', 'Zərdab', 'Rayon',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('BS', 'BHS', 'Bahamas', '', 'Commonwealth of the Bahamas');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('BS-AK', 'BS', 'AK', 'Acklins', 'District',NULL),
('BS-BY', 'BS', 'BY', 'Berry Islands', 'District',NULL),
('BS-BI', 'BS', 'BI', 'Bimini', 'District',NULL),
('BS-BP', 'BS', 'BP', 'Black Point', 'District',NULL),
('BS-CI', 'BS', 'CI', 'Cat Island', 'District',NULL),
('BS-CO', 'BS', 'CO', 'Central Abaco', 'District',NULL),
('BS-CS', 'BS', 'CS', 'Central Andros', 'District',NULL),
('BS-CE', 'BS', 'CE', 'Central Eleuthera', 'District',NULL),
('BS-FP', 'BS', 'FP', 'City of Freeport', 'District',NULL),
('BS-CK', 'BS', 'CK', 'Crooked Island and Long Cay', 'District',NULL),
('BS-EG', 'BS', 'EG', 'East Grand Bahama', 'District',NULL),
('BS-EX', 'BS', 'EX', 'Exuma', 'District',NULL),
('BS-GC', 'BS', 'GC', 'Grand Cay', 'District',NULL),
('BS-HI', 'BS', 'HI', 'Harbour Island', 'District',NULL),
('BS-HT', 'BS', 'HT', 'Hope Town', 'District',NULL),
('BS-IN', 'BS', 'IN', 'Inagua', 'District',NULL),
('BS-LI', 'BS', 'LI', 'Long Island', 'District',NULL),
('BS-MC', 'BS', 'MC', 'Mangrove Cay', 'District',NULL),
('BS-MG', 'BS', 'MG', 'Mayaguana', 'District',NULL),
('BS-MI', 'BS', 'MI', 'Moore''s Island', 'District',NULL),
('BS-NO', 'BS', 'NO', 'North Abaco', 'District',NULL),
('BS-NS', 'BS', 'NS', 'North Andros', 'District',NULL),
('BS-NE', 'BS', 'NE', 'North Eleuthera', 'District',NULL),
('BS-RI', 'BS', 'RI', 'Ragged Island', 'District',NULL),
('BS-RC', 'BS', 'RC', 'Rum Cay', 'District',NULL),
('BS-SS', 'BS', 'SS', 'San Salvador', 'District',NULL),
('BS-SO', 'BS', 'SO', 'South Abaco', 'District',NULL),
('BS-SA', 'BS', 'SA', 'South Andros', 'District',NULL),
('BS-SE', 'BS', 'SE', 'South Eleuthera', 'District',NULL),
('BS-SW', 'BS', 'SW', 'Spanish Wells', 'District',NULL),
('BS-WG', 'BS', 'WG', 'West Grand Bahama', 'District',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('BH', 'BHR', 'Bahrain', '', 'Kingdom of Bahrain');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('BH-13', 'BH', '13', 'Al Manāmah (Al ‘Āşimah)', 'Governorate',NULL),
('BH-14', 'BH', '14', 'Al Janūbīyah', 'Governorate',NULL),
('BH-15', 'BH', '15', 'Al Muḩarraq', 'Governorate',NULL),
('BH-16', 'BH', '16', 'Al Wusţá', 'Governorate',NULL),
('BH-17', 'BH', '17', 'Ash Shamālīyah', 'Governorate',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('BD', 'BGD', 'Bangladesh', '', 'People''s Republic of Bangladesh');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('BD-A', 'BD', 'A', 'Barisal', 'Division',NULL),
('BD-B', 'BD', 'B', 'Chittagong', 'Division',NULL),
('BD-C', 'BD', 'C', 'Dhaka', 'Division',NULL),
('BD-D', 'BD', 'D', 'Khulna', 'Division',NULL),
('BD-E', 'BD', 'E', 'Rajshahi', 'Division',NULL),
('BD-F', 'BD', 'F', 'Rangpur', 'Division',NULL),
('BD-G', 'BD', 'G', 'Sylhet', 'Division',NULL),
('BD-05', 'BD', '05', 'Bagerhat', 'District','BD-D'),
('BD-01', 'BD', '01', 'Bandarban', 'District','BD-B'),
('BD-02', 'BD', '02', 'Barguna', 'District','BD-A'),
('BD-06', 'BD', '06', 'Barisal', 'District','BD-A'),
('BD-07', 'BD', '07', 'Bhola', 'District','BD-A'),
('BD-03', 'BD', '03', 'Bogra', 'District','BD-E'),
('BD-04', 'BD', '04', 'Brahmanbaria', 'District','BD-B'),
('BD-09', 'BD', '09', 'Chandpur', 'District','BD-B'),
('BD-10', 'BD', '10', 'Chittagong', 'District','BD-B'),
('BD-12', 'BD', '12', 'Chuadanga', 'District','BD-D'),
('BD-08', 'BD', '08', 'Comilla', 'District','BD-B'),
('BD-11', 'BD', '11', 'Cox''s Bazar', 'District','BD-B'),
('BD-13', 'BD', '13', 'Dhaka', 'District','BD-C'),
('BD-14', 'BD', '14', 'Dinajpur', 'District','BD-F'),
('BD-15', 'BD', '15', 'Faridpur', 'District','BD-C'),
('BD-16', 'BD', '16', 'Feni', 'District','BD-B'),
('BD-19', 'BD', '19', 'Gaibandha', 'District','BD-F'),
('BD-18', 'BD', '18', 'Gazipur', 'District','BD-C'),
('BD-17', 'BD', '17', 'Gopalganj', 'District','BD-C'),
('BD-20', 'BD', '20', 'Habiganj', 'District','BD-G'),
('BD-24', 'BD', '24', 'Jaipurhat', 'District','BD-E'),
('BD-21', 'BD', '21', 'Jamalpur', 'District','BD-C'),
('BD-22', 'BD', '22', 'Jessore', 'District','BD-D'),
('BD-25', 'BD', '25', 'Jhalakati', 'District','BD-A'),
('BD-23', 'BD', '23', 'Jhenaidah', 'District','BD-D'),
('BD-29', 'BD', '29', 'Khagrachari', 'District','BD-B'),
('BD-27', 'BD', '27', 'Khulna', 'District','BD-D'),
('BD-26', 'BD', '26', 'Kishorganj', 'District','BD-C'),
('BD-28', 'BD', '28', 'Kurigram', 'District','BD-F'),
('BD-30', 'BD', '30', 'Kushtia', 'District','BD-D'),
('BD-31', 'BD', '31', 'Lakshmipur', 'District','BD-B'),
('BD-32', 'BD', '32', 'Lalmonirhat', 'District','BD-F'),
('BD-36', 'BD', '36', 'Madaripur', 'District','BD-C'),
('BD-37', 'BD', '37', 'Magura', 'District','BD-D'),
('BD-33', 'BD', '33', 'Manikganj', 'District','BD-C'),
('BD-39', 'BD', '39', 'Meherpur', 'District','BD-D'),
('BD-38', 'BD', '38', 'Moulvibazar', 'District','BD-G'),
('BD-35', 'BD', '35', 'Munshiganj', 'District','BD-C'),
('BD-34', 'BD', '34', 'Mymensingh', 'District','BD-C'),
('BD-48', 'BD', '48', 'Naogaon', 'District','BD-E'),
('BD-43', 'BD', '43', 'Narail', 'District','BD-D'),
('BD-40', 'BD', '40', 'Narayanganj', 'District','BD-C'),
('BD-42', 'BD', '42', 'Narsingdi', 'District','BD-C'),
('BD-44', 'BD', '44', 'Natore', 'District','BD-E'),
('BD-45', 'BD', '45', 'Nawabganj', 'District','BD-E'),
('BD-41', 'BD', '41', 'Netrakona', 'District','BD-C'),
('BD-46', 'BD', '46', 'Nilphamari', 'District','BD-F'),
('BD-47', 'BD', '47', 'Noakhali', 'District','BD-B'),
('BD-49', 'BD', '49', 'Pabna', 'District','BD-E'),
('BD-52', 'BD', '52', 'Panchagarh', 'District','BD-F'),
('BD-51', 'BD', '51', 'Patuakhali', 'District','BD-A'),
('BD-50', 'BD', '50', 'Pirojpur', 'District','BD-A'),
('BD-53', 'BD', '53', 'Rajbari', 'District','BD-C'),
('BD-54', 'BD', '54', 'Rajshahi', 'District','BD-E'),
('BD-56', 'BD', '56', 'Rangamati', 'District','BD-B'),
('BD-55', 'BD', '55', 'Rangpur', 'District','BD-F'),
('BD-58', 'BD', '58', 'Satkhira', 'District','BD-D'),
('BD-62', 'BD', '62', 'Shariatpur', 'District','BD-C'),
('BD-57', 'BD', '57', 'Sherpur', 'District','BD-C'),
('BD-59', 'BD', '59', 'Sirajganj', 'District','BD-E'),
('BD-61', 'BD', '61', 'Sunamganj', 'District','BD-G'),
('BD-60', 'BD', '60', 'Sylhet', 'District','BD-G'),
('BD-63', 'BD', '63', 'Tangail', 'District','BD-C'),
('BD-64', 'BD', '64', 'Thakurgaon', 'District','BD-F');

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('BB', 'BRB', 'Barbados', '', '');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('BB-01', 'BB', '01', 'Christ Church', 'Parish',NULL),
('BB-02', 'BB', '02', 'Saint Andrew', 'Parish',NULL),
('BB-03', 'BB', '03', 'Saint George', 'Parish',NULL),
('BB-04', 'BB', '04', 'Saint James', 'Parish',NULL),
('BB-05', 'BB', '05', 'Saint John', 'Parish',NULL),
('BB-06', 'BB', '06', 'Saint Joseph', 'Parish',NULL),
('BB-07', 'BB', '07', 'Saint Lucy', 'Parish',NULL),
('BB-08', 'BB', '08', 'Saint Michael', 'Parish',NULL),
('BB-09', 'BB', '09', 'Saint Peter', 'Parish',NULL),
('BB-10', 'BB', '10', 'Saint Philip', 'Parish',NULL),
('BB-11', 'BB', '11', 'Saint Thomas', 'Parish',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('BY', 'BLR', 'Belarus', '', 'Republic of Belarus');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('BY-HM', 'BY', 'HM', 'Horad Minsk', 'City',NULL),
('BY-BR', 'BY', 'BR', 'Brèsckaja voblasc''', 'Oblast',NULL),
('BY-HO', 'BY', 'HO', 'Homel''skaja voblasc''', 'Oblast',NULL),
('BY-HR', 'BY', 'HR', 'Hrodzenskaja voblasc''', 'Oblast',NULL),
('BY-MA', 'BY', 'MA', 'Mahilëuskaja voblasc''', 'Oblast',NULL),
('BY-MI', 'BY', 'MI', 'Minskaja voblasc''', 'Oblast',NULL),
('BY-VI', 'BY', 'VI', 'Vicebskaja voblasc''', 'Oblast',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('BE', 'BEL', 'Belgium', '', 'Kingdom of Belgium');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('BE-BRU', 'BE', 'BRU', 'Bruxelles-Capitale, Région de;Brussels Hoofdstedelijk Gewest', 'Region',NULL),
('BE-VLG', 'BE', 'VLG', 'Vlaams Gewest', 'Region',NULL),
('BE-WAL', 'BE', 'WAL', 'wallonne, Région', 'Region',NULL),
('BE-VAN', 'BE', 'VAN', 'Antwerpen', 'Province','BE-VLG'),
('BE-WBR', 'BE', 'WBR', 'Brabant wallon', 'Province','BE-WAL'),
('BE-WHT', 'BE', 'WHT', 'Hainaut', 'Province','BE-WAL'),
('BE-WLG', 'BE', 'WLG', 'Liège', 'Province','BE-WAL'),
('BE-VLI', 'BE', 'VLI', 'Limburg', 'Province','BE-VLG'),
('BE-WLX', 'BE', 'WLX', 'Luxembourg', 'Province','BE-WAL'),
('BE-WNA', 'BE', 'WNA', 'Namur', 'Province','BE-WAL'),
('BE-VOV', 'BE', 'VOV', 'Oost-Vlaanderen', 'Province','BE-VLG'),
('BE-VBR', 'BE', 'VBR', 'Vlaams-Brabant', 'Province','BE-VLG'),
('BE-VWV', 'BE', 'VWV', 'West-Vlaanderen', 'Province','BE-VLG');

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('BZ', 'BLZ', 'Belize', '', '');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('BZ-BZ', 'BZ', 'BZ', 'Belize', 'District',NULL),
('BZ-CY', 'BZ', 'CY', 'Cayo', 'District',NULL),
('BZ-CZL', 'BZ', 'CZL', 'Corozal', 'District',NULL),
('BZ-OW', 'BZ', 'OW', 'Orange Walk', 'District',NULL),
('BZ-SC', 'BZ', 'SC', 'Stann Creek', 'District',NULL),
('BZ-TOL', 'BZ', 'TOL', 'Toledo', 'District',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('BJ', 'BEN', 'Benin', '', 'Republic of Benin');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('BJ-AL', 'BJ', 'AL', 'Alibori', 'Department',NULL),
('BJ-AK', 'BJ', 'AK', 'Atakora', 'Department',NULL),
('BJ-AQ', 'BJ', 'AQ', 'Atlantique', 'Department',NULL),
('BJ-BO', 'BJ', 'BO', 'Borgou', 'Department',NULL),
('BJ-CO', 'BJ', 'CO', 'Collines', 'Department',NULL),
('BJ-DO', 'BJ', 'DO', 'Donga', 'Department',NULL),
('BJ-KO', 'BJ', 'KO', 'Kouffo', 'Department',NULL),
('BJ-LI', 'BJ', 'LI', 'Littoral', 'Department',NULL),
('BJ-MO', 'BJ', 'MO', 'Mono', 'Department',NULL),
('BJ-OU', 'BJ', 'OU', 'Ouémé', 'Department',NULL),
('BJ-PL', 'BJ', 'PL', 'Plateau', 'Department',NULL),
('BJ-ZO', 'BJ', 'ZO', 'Zou', 'Department',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('BM', 'BMU', 'Bermuda', '', '');

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('BT', 'BTN', 'Bhutan', '', 'Kingdom of Bhutan');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('BT-33', 'BT', '33', 'Bumthang', 'District',NULL),
('BT-12', 'BT', '12', 'Chhukha', 'District',NULL),
('BT-22', 'BT', '22', 'Dagana', 'District',NULL),
('BT-GA', 'BT', 'GA', 'Gasa', 'District',NULL),
('BT-13', 'BT', '13', 'Ha', 'District',NULL),
('BT-44', 'BT', '44', 'Lhuentse', 'District',NULL),
('BT-42', 'BT', '42', 'Monggar', 'District',NULL),
('BT-11', 'BT', '11', 'Paro', 'District',NULL),
('BT-43', 'BT', '43', 'Pemagatshel', 'District',NULL),
('BT-23', 'BT', '23', 'Punakha', 'District',NULL),
('BT-45', 'BT', '45', 'Samdrup Jongkha', 'District',NULL),
('BT-14', 'BT', '14', 'Samtee', 'District',NULL),
('BT-31', 'BT', '31', 'Sarpang', 'District',NULL),
('BT-15', 'BT', '15', 'Thimphu', 'District',NULL),
('BT-41', 'BT', '41', 'Trashigang', 'District',NULL),
('BT-TY', 'BT', 'TY', 'Trashi Yangtse', 'District',NULL),
('BT-32', 'BT', '32', 'Trongsa', 'District',NULL),
('BT-21', 'BT', '21', 'Tsirang', 'District',NULL),
('BT-24', 'BT', '24', 'Wangdue Phodrang', 'District',NULL),
('BT-34', 'BT', '34', 'Zhemgang', 'District',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('BO', 'BOL', 'Bolivia, Plurinational State of', 'Bolivia', 'Plurinational State of Bolivia');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('BO-H', 'BO', 'H', 'Chuquisaca', 'Department',NULL),
('BO-C', 'BO', 'C', 'Cochabamba', 'Department',NULL),
('BO-B', 'BO', 'B', 'El Beni', 'Department',NULL),
('BO-L', 'BO', 'L', 'La Paz', 'Department',NULL),
('BO-O', 'BO', 'O', 'Oruro', 'Department',NULL),
('BO-N', 'BO', 'N', 'Pando', 'Department',NULL),
('BO-P', 'BO', 'P', 'Potosí', 'Department',NULL),
('BO-S', 'BO', 'S', 'Santa Cruz', 'Department',NULL),
('BO-T', 'BO', 'T', 'Tarija', 'Department',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('BQ', 'BES', 'Bonaire, Sint Eustatius and Saba', '', 'Bonaire, Sint Eustatius and Saba');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('BQ-BO', 'BQ', 'BO', 'Bonaire', 'Special municipality',NULL),
('BQ-SA', 'BQ', 'SA', 'Saba', 'Special municipality',NULL),
('BQ-SE', 'BQ', 'SE', 'Sint Eustatius', 'Special municipality',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('BA', 'BIH', 'Bosnia and Herzegovina', '', 'Republic of Bosnia and Herzegovina');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('BA-BIH', 'BA', 'BIH', 'Federacija Bosne i Hercegovine', 'Entity',NULL),
('BA-SRP', 'BA', 'SRP', 'Republika Srpska', 'Entity',NULL),
('BA-05', 'BA', '05', 'Bosansko-podrinjski kanton', 'Canton','BA-BIH'),
('BA-07', 'BA', '07', 'Hercegovačko-neretvanski kanton', 'Canton','BA-BIH'),
('BA-10', 'BA', '10', 'Kanton br. 10 (Livanjski kanton)', 'Canton','BA-BIH'),
('BA-09', 'BA', '09', 'Kanton Sarajevo', 'Canton','BA-BIH'),
('BA-02', 'BA', '02', 'Posavski kanton', 'Canton','BA-BIH'),
('BA-06', 'BA', '06', 'Srednjobosanski kanton', 'Canton','BA-BIH'),
('BA-03', 'BA', '03', 'Tuzlanski kanton', 'Canton','BA-BIH'),
('BA-01', 'BA', '01', 'Unsko-sanski kanton', 'Canton','BA-BIH'),
('BA-08', 'BA', '08', 'Zapadnohercegovački kanton', 'Canton','BA-BIH'),
('BA-04', 'BA', '04', 'Zeničko-dobojski kanton', 'Canton','BA-BIH'),
('BA-BRC', 'BA', 'BRC', 'Brčko distrikt', 'District',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('BW', 'BWA', 'Botswana', '', 'Republic of Botswana');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('BW-CE', 'BW', 'CE', 'Central', 'District',NULL),
('BW-GH', 'BW', 'GH', 'Ghanzi', 'District',NULL),
('BW-KG', 'BW', 'KG', 'Kgalagadi', 'District',NULL),
('BW-KL', 'BW', 'KL', 'Kgatleng', 'District',NULL),
('BW-KW', 'BW', 'KW', 'Kweneng', 'District',NULL),
('BW-NE', 'BW', 'NE', 'North-East', 'District',NULL),
('BW-NW', 'BW', 'NW', 'North-West', 'District',NULL),
('BW-SE', 'BW', 'SE', 'South-East', 'District',NULL),
('BW-SO', 'BW', 'SO', 'Southern', 'District',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('BV', 'BVT', 'Bouvet Island', '', '');

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('BR', 'BRA', 'Brazil', '', 'Federative Republic of Brazil');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('BR-AC', 'BR', 'AC', 'Acre', 'State',NULL),
('BR-AL', 'BR', 'AL', 'Alagoas', 'State',NULL),
('BR-AM', 'BR', 'AM', 'Amazonas', 'State',NULL),
('BR-AP', 'BR', 'AP', 'Amapá', 'State',NULL),
('BR-BA', 'BR', 'BA', 'Bahia', 'State',NULL),
('BR-CE', 'BR', 'CE', 'Ceará', 'State',NULL),
('BR-ES', 'BR', 'ES', 'Espírito Santo', 'State',NULL),
('BR-FN', 'BR', 'FN', 'Fernando de Noronha', 'State',NULL),
('BR-GO', 'BR', 'GO', 'Goiás', 'State',NULL),
('BR-MA', 'BR', 'MA', 'Maranhão', 'State',NULL),
('BR-MG', 'BR', 'MG', 'Minas Gerais', 'State',NULL),
('BR-MS', 'BR', 'MS', 'Mato Grosso do Sul', 'State',NULL),
('BR-MT', 'BR', 'MT', 'Mato Grosso', 'State',NULL),
('BR-PA', 'BR', 'PA', 'Pará', 'State',NULL),
('BR-PB', 'BR', 'PB', 'Paraíba', 'State',NULL),
('BR-PE', 'BR', 'PE', 'Pernambuco', 'State',NULL),
('BR-PI', 'BR', 'PI', 'Piauí', 'State',NULL),
('BR-PR', 'BR', 'PR', 'Paraná', 'State',NULL),
('BR-RJ', 'BR', 'RJ', 'Rio de Janeiro', 'State',NULL),
('BR-RN', 'BR', 'RN', 'Rio Grande do Norte', 'State',NULL),
('BR-RO', 'BR', 'RO', 'Rondônia', 'State',NULL),
('BR-RR', 'BR', 'RR', 'Roraima', 'State',NULL),
('BR-RS', 'BR', 'RS', 'Rio Grande do Sul', 'State',NULL),
('BR-SC', 'BR', 'SC', 'Santa Catarina', 'State',NULL),
('BR-SE', 'BR', 'SE', 'Sergipe', 'State',NULL),
('BR-SP', 'BR', 'SP', 'São Paulo', 'State',NULL),
('BR-TO', 'BR', 'TO', 'Tocantins', 'State',NULL),
('BR-DF', 'BR', 'DF', 'Distrito Federal', 'Federal District',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('IO', 'IOT', 'British Indian Ocean Territory', '', '');

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('BN', 'BRN', 'Brunei Darussalam', '', '');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('BN-BE', 'BN', 'BE', 'Belait', 'District',NULL),
('BN-BM', 'BN', 'BM', 'Brunei-Muara', 'District',NULL),
('BN-TE', 'BN', 'TE', 'Temburong', 'District',NULL),
('BN-TU', 'BN', 'TU', 'Tutong', 'District',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('BG', 'BGR', 'Bulgaria', '', 'Republic of Bulgaria');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('BG-01', 'BG', '01', 'Blagoevgrad', 'Region',NULL),
('BG-02', 'BG', '02', 'Burgas', 'Region',NULL),
('BG-08', 'BG', '08', 'Dobrich', 'Region',NULL),
('BG-07', 'BG', '07', 'Gabrovo', 'Region',NULL),
('BG-26', 'BG', '26', 'Haskovo', 'Region',NULL),
('BG-09', 'BG', '09', 'Kardzhali', 'Region',NULL),
('BG-10', 'BG', '10', 'Kyustendil', 'Region',NULL),
('BG-11', 'BG', '11', 'Lovech', 'Region',NULL),
('BG-12', 'BG', '12', 'Montana', 'Region',NULL),
('BG-13', 'BG', '13', 'Pazardzhik', 'Region',NULL),
('BG-14', 'BG', '14', 'Pernik', 'Region',NULL),
('BG-15', 'BG', '15', 'Pleven', 'Region',NULL),
('BG-16', 'BG', '16', 'Plovdiv', 'Region',NULL),
('BG-17', 'BG', '17', 'Razgrad', 'Region',NULL),
('BG-18', 'BG', '18', 'Ruse', 'Region',NULL),
('BG-27', 'BG', '27', 'Shumen', 'Region',NULL),
('BG-19', 'BG', '19', 'Silistra', 'Region',NULL),
('BG-20', 'BG', '20', 'Sliven', 'Region',NULL),
('BG-21', 'BG', '21', 'Smolyan', 'Region',NULL),
('BG-23', 'BG', '23', 'Sofia', 'Region',NULL),
('BG-22', 'BG', '22', 'Sofia-Grad', 'Region',NULL),
('BG-24', 'BG', '24', 'Stara Zagora', 'Region',NULL),
('BG-25', 'BG', '25', 'Targovishte', 'Region',NULL),
('BG-03', 'BG', '03', 'Varna', 'Region',NULL),
('BG-04', 'BG', '04', 'Veliko Tarnovo', 'Region',NULL),
('BG-05', 'BG', '05', 'Vidin', 'Region',NULL),
('BG-06', 'BG', '06', 'Vratsa', 'Region',NULL),
('BG-28', 'BG', '28', 'Yambol', 'Region',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('BF', 'BFA', 'Burkina Faso', '', '');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('BF-01', 'BF', '01', 'Boucle du Mouhoun', 'Region',NULL),
('BF-02', 'BF', '02', 'Cascades', 'Region',NULL),
('BF-03', 'BF', '03', 'Centre', 'Region',NULL),
('BF-04', 'BF', '04', 'Centre-Est', 'Region',NULL),
('BF-05', 'BF', '05', 'Centre-Nord', 'Region',NULL),
('BF-06', 'BF', '06', 'Centre-Ouest', 'Region',NULL),
('BF-07', 'BF', '07', 'Centre-Sud', 'Region',NULL),
('BF-08', 'BF', '08', 'Est', 'Region',NULL),
('BF-09', 'BF', '09', 'Hauts-Bassins', 'Region',NULL),
('BF-10', 'BF', '10', 'Nord', 'Region',NULL),
('BF-11', 'BF', '11', 'Plateau-Central', 'Region',NULL),
('BF-12', 'BF', '12', 'Sahel', 'Region',NULL),
('BF-13', 'BF', '13', 'Sud-Ouest', 'Region',NULL),
('BF-BAL', 'BF', 'BAL', 'Balé', 'Province','BF-01'),
('BF-BAM', 'BF', 'BAM', 'Bam', 'Province','BF-05'),
('BF-BAN', 'BF', 'BAN', 'Banwa', 'Province','BF-01'),
('BF-BAZ', 'BF', 'BAZ', 'Bazèga', 'Province','BF-07'),
('BF-BGR', 'BF', 'BGR', 'Bougouriba', 'Province','BF-13'),
('BF-BLG', 'BF', 'BLG', 'Boulgou', 'Province','BF-04'),
('BF-BLK', 'BF', 'BLK', 'Boulkiemdé', 'Province','BF-06'),
('BF-COM', 'BF', 'COM', 'Comoé', 'Province','BF-02'),
('BF-GAN', 'BF', 'GAN', 'Ganzourgou', 'Province','BF-11'),
('BF-GNA', 'BF', 'GNA', 'Gnagna', 'Province','BF-08'),
('BF-GOU', 'BF', 'GOU', 'Gourma', 'Province','BF-08'),
('BF-HOU', 'BF', 'HOU', 'Houet', 'Province','BF-09'),
('BF-IOB', 'BF', 'IOB', 'Ioba', 'Province','BF-13'),
('BF-KAD', 'BF', 'KAD', 'Kadiogo', 'Province','BF-03'),
('BF-KEN', 'BF', 'KEN', 'Kénédougou', 'Province','BF-09'),
('BF-KMD', 'BF', 'KMD', 'Komondjari', 'Province','BF-08'),
('BF-KMP', 'BF', 'KMP', 'Kompienga', 'Province','BF-08'),
('BF-KOS', 'BF', 'KOS', 'Kossi', 'Province','BF-01'),
('BF-KOP', 'BF', 'KOP', 'Koulpélogo', 'Province','BF-04'),
('BF-KOT', 'BF', 'KOT', 'Kouritenga', 'Province','BF-04'),
('BF-KOW', 'BF', 'KOW', 'Kourwéogo', 'Province','BF-11'),
('BF-LER', 'BF', 'LER', 'Léraba', 'Province','BF-02'),
('BF-LOR', 'BF', 'LOR', 'Loroum', 'Province','BF-10'),
('BF-MOU', 'BF', 'MOU', 'Mouhoun', 'Province','BF-01'),
('BF-NAO', 'BF', 'NAO', 'Naouri', 'Province','BF-07'),
('BF-NAM', 'BF', 'NAM', 'Namentenga', 'Province','BF-05'),
('BF-NAY', 'BF', 'NAY', 'Nayala', 'Province','BF-01'),
('BF-NOU', 'BF', 'NOU', 'Noumbiel', 'Province','BF-13'),
('BF-OUB', 'BF', 'OUB', 'Oubritenga', 'Province','BF-11'),
('BF-OUD', 'BF', 'OUD', 'Oudalan', 'Province','BF-12'),
('BF-PAS', 'BF', 'PAS', 'Passoré', 'Province','BF-10'),
('BF-PON', 'BF', 'PON', 'Poni', 'Province','BF-13'),
('BF-SNG', 'BF', 'SNG', 'Sanguié', 'Province','BF-06'),
('BF-SMT', 'BF', 'SMT', 'Sanmatenga', 'Province','BF-05'),
('BF-SEN', 'BF', 'SEN', 'Séno', 'Province','BF-12'),
('BF-SIS', 'BF', 'SIS', 'Sissili', 'Province','BF-06'),
('BF-SOM', 'BF', 'SOM', 'Soum', 'Province','BF-12'),
('BF-SOR', 'BF', 'SOR', 'Sourou', 'Province','BF-01'),
('BF-TAP', 'BF', 'TAP', 'Tapoa', 'Province','BF-08'),
('BF-TUI', 'BF', 'TUI', 'Tui', 'Province','BF-09'),
('BF-YAG', 'BF', 'YAG', 'Yagha', 'Province','BF-12'),
('BF-YAT', 'BF', 'YAT', 'Yatenga', 'Province','BF-10'),
('BF-ZIR', 'BF', 'ZIR', 'Ziro', 'Province','BF-06'),
('BF-ZON', 'BF', 'ZON', 'Zondoma', 'Province','BF-10'),
('BF-ZOU', 'BF', 'ZOU', 'Zoundwéogo', 'Province','BF-07');

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('BI', 'BDI', 'Burundi', '', 'Republic of Burundi');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('BI-BB', 'BI', 'BB', 'Bubanza', 'Province',NULL),
('BI-BM', 'BI', 'BM', 'Bujumbura Mairie', 'Province',NULL),
('BI-BL', 'BI', 'BL', 'Bujumbura Rural', 'Province',NULL),
('BI-BR', 'BI', 'BR', 'Bururi', 'Province',NULL),
('BI-CA', 'BI', 'CA', 'Cankuzo', 'Province',NULL),
('BI-CI', 'BI', 'CI', 'Cibitoke', 'Province',NULL),
('BI-GI', 'BI', 'GI', 'Gitega', 'Province',NULL),
('BI-KR', 'BI', 'KR', 'Karuzi', 'Province',NULL),
('BI-KY', 'BI', 'KY', 'Kayanza', 'Province',NULL),
('BI-KI', 'BI', 'KI', 'Kirundo', 'Province',NULL),
('BI-MA', 'BI', 'MA', 'Makamba', 'Province',NULL),
('BI-MU', 'BI', 'MU', 'Muramvya', 'Province',NULL),
('BI-MW', 'BI', 'MW', 'Mwaro', 'Province',NULL),
('BI-NG', 'BI', 'NG', 'Ngozi', 'Province',NULL),
('BI-RT', 'BI', 'RT', 'Rutana', 'Province',NULL),
('BI-RY', 'BI', 'RY', 'Ruyigi', 'Province',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('KH', 'KHM', 'Cambodia', '', 'Kingdom of Cambodia');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('KH-23', 'KH', '23', 'Krong Kaeb', 'Autonomous municipality',NULL),
('KH-24', 'KH', '24', 'Krong Pailin', 'Autonomous municipality',NULL),
('KH-18', 'KH', '18', 'Krong Preah Sihanouk', 'Autonomous municipality',NULL),
('KH-12', 'KH', '12', 'Phnom Penh', 'Autonomous municipality',NULL),
('KH-2', 'KH', '2', 'Battambang', 'Province',NULL),
('KH-1', 'KH', '1', 'Banteay Mean Chey', 'Province',NULL),
('KH-3', 'KH', '3', 'Kampong Cham', 'Province',NULL),
('KH-4', 'KH', '4', 'Kampong Chhnang', 'Province',NULL),
('KH-5', 'KH', '5', 'Kampong Speu', 'Province',NULL),
('KH-6', 'KH', '6', 'Kampong Thom', 'Province',NULL),
('KH-7', 'KH', '7', 'Kampot', 'Province',NULL),
('KH-8', 'KH', '8', 'Kandal', 'Province',NULL),
('KH-9', 'KH', '9', 'Kach Kong', 'Province',NULL),
('KH-10', 'KH', '10', 'Krachoh', 'Province',NULL),
('KH-11', 'KH', '11', 'Mondol Kiri', 'Province',NULL),
('KH-22', 'KH', '22', 'Otdar Mean Chey', 'Province',NULL),
('KH-15', 'KH', '15', 'Pousaat', 'Province',NULL),
('KH-13', 'KH', '13', 'Preah Vihear', 'Province',NULL),
('KH-14', 'KH', '14', 'Prey Veaeng', 'Province',NULL),
('KH-16', 'KH', '16', 'Rotanak Kiri', 'Province',NULL),
('KH-17', 'KH', '17', 'Siem Reab', 'Province',NULL),
('KH-19', 'KH', '19', 'Stueng Traeng', 'Province',NULL),
('KH-20', 'KH', '20', 'Svaay Rieng', 'Province',NULL),
('KH-21', 'KH', '21', 'Taakaev', 'Province',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('CM', 'CMR', 'Cameroon', '', 'Republic of Cameroon');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('CM-AD', 'CM', 'AD', 'Adamaoua', 'Province',NULL),
('CM-CE', 'CM', 'CE', 'Centre', 'Province',NULL),
('CM-ES', 'CM', 'ES', 'East', 'Province',NULL),
('CM-EN', 'CM', 'EN', 'Far North', 'Province',NULL),
('CM-LT', 'CM', 'LT', 'Littoral', 'Province',NULL),
('CM-NO', 'CM', 'NO', 'North', 'Province',NULL),
('CM-NW', 'CM', 'NW', 'North-West (Cameroon)', 'Province',NULL),
('CM-SU', 'CM', 'SU', 'South', 'Province',NULL),
('CM-SW', 'CM', 'SW', 'South-West', 'Province',NULL),
('CM-OU', 'CM', 'OU', 'West', 'Province',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('CA', 'CAN', 'Canada', '', '');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('CA-AB', 'CA', 'AB', 'Alberta', 'Province',NULL),
('CA-BC', 'CA', 'BC', 'British Columbia', 'Province',NULL),
('CA-MB', 'CA', 'MB', 'Manitoba', 'Province',NULL),
('CA-NB', 'CA', 'NB', 'New Brunswick', 'Province',NULL),
('CA-NL', 'CA', 'NL', 'Newfoundland and Labrador', 'Province',NULL),
('CA-NS', 'CA', 'NS', 'Nova Scotia', 'Province',NULL),
('CA-ON', 'CA', 'ON', 'Ontario', 'Province',NULL),
('CA-PE', 'CA', 'PE', 'Prince Edward Island', 'Province',NULL),
('CA-QC', 'CA', 'QC', 'Quebec', 'Province',NULL),
('CA-SK', 'CA', 'SK', 'Saskatchewan', 'Province',NULL),
('CA-NT', 'CA', 'NT', 'Northwest Territories', 'Territory',NULL),
('CA-NU', 'CA', 'NU', 'Nunavut', 'Territory',NULL),
('CA-YT', 'CA', 'YT', 'Yukon Territory', 'Territory',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('CV', 'CPV', 'Cape Verde', '', 'Republic of Cape Verde');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('CV-B', 'CV', 'B', 'Ilhas de Barlavento', 'Geographical region',NULL),
('CV-S', 'CV', 'S', 'Ilhas de Sotavento', 'Geographical region',NULL),
('CV-BV', 'CV', 'BV', 'Boa Vista', 'Municipality','CV-B'),
('CV-BR', 'CV', 'BR', 'Brava', 'Municipality','CV-S'),
('CV-MA', 'CV', 'MA', 'Maio', 'Municipality','CV-S'),
('CV-MO', 'CV', 'MO', 'Mosteiros', 'Municipality','CV-S'),
('CV-PA', 'CV', 'PA', 'Paul', 'Municipality','CV-B'),
('CV-PN', 'CV', 'PN', 'Porto Novo', 'Municipality','CV-B'),
('CV-PR', 'CV', 'PR', 'Praia', 'Municipality','CV-S'),
('CV-RB', 'CV', 'RB', 'Ribeira Brava', 'Municipality','CV-B'),
('CV-RG', 'CV', 'RG', 'Ribeira Grande', 'Municipality','CV-B'),
('CV-RS', 'CV', 'RS', 'Ribeira Grande de Santiago', 'Municipality','CV-S'),
('CV-SL', 'CV', 'SL', 'Sal', 'Municipality','CV-B'),
('CV-CA', 'CV', 'CA', 'Santa Catarina', 'Municipality','CV-S'),
('CV-CF', 'CV', 'CF', 'Santa Catarina de Fogo', 'Municipality','CV-S'),
('CV-CR', 'CV', 'CR', 'Santa Cruz', 'Municipality','CV-S'),
('CV-SD', 'CV', 'SD', 'São Domingos', 'Municipality','CV-S'),
('CV-SF', 'CV', 'SF', 'São Filipe', 'Municipality','CV-S'),
('CV-SO', 'CV', 'SO', 'São Lourenço dos Órgãos', 'Municipality','CV-S'),
('CV-SM', 'CV', 'SM', 'São Miguel', 'Municipality','CV-S'),
('CV-SS', 'CV', 'SS', 'São Salvador do Mundo', 'Municipality','CV-S'),
('CV-SV', 'CV', 'SV', 'São Vicente', 'Municipality','CV-B'),
('CV-TA', 'CV', 'TA', 'Tarrafal', 'Municipality','CV-S'),
('CV-TS', 'CV', 'TS', 'Tarrafal de São Nicolau', 'Municipality','CV-S');

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('KY', 'CYM', 'Cayman Islands', '', '');

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('CF', 'CAF', 'Central African Republic', '', '');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('CF-BGF', 'CF', 'BGF', 'Bangui', 'Commune',NULL),
('CF-BB', 'CF', 'BB', 'Bamingui-Bangoran', 'Prefecture',NULL),
('CF-BK', 'CF', 'BK', 'Basse-Kotto', 'Prefecture',NULL),
('CF-HK', 'CF', 'HK', 'Haute-Kotto', 'Prefecture',NULL),
('CF-HM', 'CF', 'HM', 'Haut-Mbomou', 'Prefecture',NULL),
('CF-KG', 'CF', 'KG', 'Kémo-Gribingui', 'Prefecture',NULL),
('CF-LB', 'CF', 'LB', 'Lobaye', 'Prefecture',NULL),
('CF-HS', 'CF', 'HS', 'Haute-Sangha / Mambéré-Kadéï', 'Prefecture',NULL),
('CF-MB', 'CF', 'MB', 'Mbomou', 'Prefecture',NULL),
('CF-NM', 'CF', 'NM', 'Nana-Mambéré', 'Prefecture',NULL),
('CF-MP', 'CF', 'MP', 'Ombella-M''poko', 'Prefecture',NULL),
('CF-UK', 'CF', 'UK', 'Ouaka', 'Prefecture',NULL),
('CF-AC', 'CF', 'AC', 'Ouham', 'Prefecture',NULL),
('CF-OP', 'CF', 'OP', 'Ouham-Pendé', 'Prefecture',NULL),
('CF-VK', 'CF', 'VK', 'Vakaga', 'Prefecture',NULL),
('CF-KB', 'CF', 'KB', 'Gribingui', 'Economic Prefecture',NULL),
('CF-SE', 'CF', 'SE', 'Sangha', 'Economic Prefecture',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('TD', 'TCD', 'Chad', '', 'Republic of Chad');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('TD-BA', 'TD', 'BA', 'Al Baṭḩah', 'Region',NULL),
('TD-LC', 'TD', 'LC', 'Al Buḩayrah', 'Region',NULL),
('TD-BG', 'TD', 'BG', 'Baḩr al Ghazāl', 'Region',NULL),
('TD-BO', 'TD', 'BO', 'Būrkū', 'Region',NULL),
('TD-HL', 'TD', 'HL', 'Ḥajjar Lamīs', 'Region',NULL),
('TD-EN', 'TD', 'EN', 'Innīdī', 'Region',NULL),
('TD-KA', 'TD', 'KA', 'Kānim', 'Region',NULL),
('TD-LO', 'TD', 'LO', 'Lūqūn al Gharbī', 'Region',NULL),
('TD-LR', 'TD', 'LR', 'Lūqūn ash Sharqī', 'Region',NULL),
('TD-ND', 'TD', 'ND', 'Madīnat Injamīnā', 'Region',NULL),
('TD-MA', 'TD', 'MA', 'Māndūl', 'Region',NULL),
('TD-MO', 'TD', 'MO', 'Māyū Kībbī al Gharbī', 'Region',NULL),
('TD-ME', 'TD', 'ME', 'Māyū Kībbī ash Sharqī', 'Region',NULL),
('TD-GR', 'TD', 'GR', 'Qīrā', 'Region',NULL),
('TD-SA', 'TD', 'SA', 'Salāmāt', 'Region',NULL),
('TD-MC', 'TD', 'MC', 'Shārī al Awsaṭ', 'Region',NULL),
('TD-CB', 'TD', 'CB', 'Shārī Bāqirmī', 'Region',NULL),
('TD-SI', 'TD', 'SI', 'Sīlā', 'Region',NULL),
('TD-TA', 'TD', 'TA', 'Tānjilī', 'Region',NULL),
('TD-TI', 'TD', 'TI', 'Tibastī', 'Region',NULL),
('TD-OD', 'TD', 'OD', 'Waddāy', 'Region',NULL),
('TD-WF', 'TD', 'WF', 'Wādī Fīrā', 'Region',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('CL', 'CHL', 'Chile', '', 'Republic of Chile');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('CL-AI', 'CL', 'AI', 'Aisén del General Carlos Ibáñez del Campo', 'Region',NULL),
('CL-AN', 'CL', 'AN', 'Antofagasta', 'Region',NULL),
('CL-AR', 'CL', 'AR', 'Araucanía', 'Region',NULL),
('CL-AP', 'CL', 'AP', 'Arica y Parinacota', 'Region',NULL),
('CL-AT', 'CL', 'AT', 'Atacama', 'Region',NULL),
('CL-BI', 'CL', 'BI', 'Bío-Bío', 'Region',NULL),
('CL-CO', 'CL', 'CO', 'Coquimbo', 'Region',NULL),
('CL-LI', 'CL', 'LI', 'Libertador General Bernardo O''Higgins', 'Region',NULL),
('CL-LL', 'CL', 'LL', 'Los Lagos', 'Region',NULL),
('CL-LR', 'CL', 'LR', 'Los Ríos', 'Region',NULL),
('CL-MA', 'CL', 'MA', 'Magallanes y Antártica Chilena', 'Region',NULL),
('CL-ML', 'CL', 'ML', 'Maule', 'Region',NULL),
('CL-RM', 'CL', 'RM', 'Región Metropolitana de Santiago', 'Region',NULL),
('CL-TA', 'CL', 'TA', 'Tarapacá', 'Region',NULL),
('CL-VS', 'CL', 'VS', 'Valparaíso', 'Region',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('CN', 'CHN', 'China', '', 'People''s Republic of China');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('CN-11', 'CN', '11', 'Beijing', 'Municipality',NULL),
('CN-50', 'CN', '50', 'Chongqing', 'Municipality',NULL),
('CN-31', 'CN', '31', 'Shanghai', 'Municipality',NULL),
('CN-12', 'CN', '12', 'Tianjin', 'Municipality',NULL),
('CN-34', 'CN', '34', 'Anhui', 'Province',NULL),
('CN-35', 'CN', '35', 'Fujian', 'Province',NULL),
('CN-62', 'CN', '62', 'Gansu', 'Province',NULL),
('CN-44', 'CN', '44', 'Guangdong', 'Province',NULL),
('CN-52', 'CN', '52', 'Guizhou', 'Province',NULL),
('CN-46', 'CN', '46', 'Hainan', 'Province',NULL),
('CN-13', 'CN', '13', 'Hebei', 'Province',NULL),
('CN-23', 'CN', '23', 'Heilongjiang', 'Province',NULL),
('CN-41', 'CN', '41', 'Henan', 'Province',NULL),
('CN-42', 'CN', '42', 'Hubei', 'Province',NULL),
('CN-43', 'CN', '43', 'Hunan', 'Province',NULL),
('CN-32', 'CN', '32', 'Jiangsu', 'Province',NULL),
('CN-36', 'CN', '36', 'Jiangxi', 'Province',NULL),
('CN-22', 'CN', '22', 'Jilin', 'Province',NULL),
('CN-21', 'CN', '21', 'Liaoning', 'Province',NULL),
('CN-63', 'CN', '63', 'Qinghai', 'Province',NULL),
('CN-61', 'CN', '61', 'Shaanxi', 'Province',NULL),
('CN-37', 'CN', '37', 'Shandong', 'Province',NULL),
('CN-14', 'CN', '14', 'Shanxi', 'Province',NULL),
('CN-51', 'CN', '51', 'Sichuan', 'Province',NULL),
('CN-71', 'CN', '71', 'Taiwan', 'Province',NULL),
('CN-53', 'CN', '53', 'Yunnan', 'Province',NULL),
('CN-33', 'CN', '33', 'Zhejiang', 'Province',NULL),
('CN-45', 'CN', '45', 'Guangxi', 'Autonomous region',NULL),
('CN-15', 'CN', '15', 'Nei Mongol', 'Autonomous region',NULL),
('CN-64', 'CN', '64', 'Ningxia', 'Autonomous region',NULL),
('CN-65', 'CN', '65', 'Xinjiang', 'Autonomous region',NULL),
('CN-54', 'CN', '54', 'Xizang', 'Autonomous region',NULL),
('CN-91', 'CN', '91', 'Xianggang (Hong-Kong)', 'Special administrative region',NULL),
('CN-92', 'CN', '92', 'Aomen (Macau)', 'Special administrative region',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('CX', 'CXR', 'Christmas Island', '', '');

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('CC', 'CCK', 'Cocos (Keeling) Islands', '', '');

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('CO', 'COL', 'Colombia', '', 'Republic of Colombia');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('CO-DC', 'CO', 'DC', 'Distrito Capital de Bogotá', 'Capital district',NULL),
('CO-AMA', 'CO', 'AMA', 'Amazonas', 'Department',NULL),
('CO-ANT', 'CO', 'ANT', 'Antioquia', 'Department',NULL),
('CO-ARA', 'CO', 'ARA', 'Arauca', 'Department',NULL),
('CO-ATL', 'CO', 'ATL', 'Atlántico', 'Department',NULL),
('CO-BOL', 'CO', 'BOL', 'Bolívar', 'Department',NULL),
('CO-BOY', 'CO', 'BOY', 'Boyacá', 'Department',NULL),
('CO-CAL', 'CO', 'CAL', 'Caldas', 'Department',NULL),
('CO-CAQ', 'CO', 'CAQ', 'Caquetá', 'Department',NULL),
('CO-CAS', 'CO', 'CAS', 'Casanare', 'Department',NULL),
('CO-CAU', 'CO', 'CAU', 'Cauca', 'Department',NULL),
('CO-CES', 'CO', 'CES', 'Cesar', 'Department',NULL),
('CO-CHO', 'CO', 'CHO', 'Chocó', 'Department',NULL),
('CO-COR', 'CO', 'COR', 'Córdoba', 'Department',NULL),
('CO-CUN', 'CO', 'CUN', 'Cundinamarca', 'Department',NULL),
('CO-GUA', 'CO', 'GUA', 'Guainía', 'Department',NULL),
('CO-GUV', 'CO', 'GUV', 'Guaviare', 'Department',NULL),
('CO-HUI', 'CO', 'HUI', 'Huila', 'Department',NULL),
('CO-LAG', 'CO', 'LAG', 'La Guajira', 'Department',NULL),
('CO-MAG', 'CO', 'MAG', 'Magdalena', 'Department',NULL),
('CO-MET', 'CO', 'MET', 'Meta', 'Department',NULL),
('CO-NAR', 'CO', 'NAR', 'Nariño', 'Department',NULL),
('CO-NSA', 'CO', 'NSA', 'Norte de Santander', 'Department',NULL),
('CO-PUT', 'CO', 'PUT', 'Putumayo', 'Department',NULL),
('CO-QUI', 'CO', 'QUI', 'Quindío', 'Department',NULL),
('CO-RIS', 'CO', 'RIS', 'Risaralda', 'Department',NULL),
('CO-SAP', 'CO', 'SAP', 'San Andrés, Providencia y Santa Catalina', 'Department',NULL),
('CO-SAN', 'CO', 'SAN', 'Santander', 'Department',NULL),
('CO-SUC', 'CO', 'SUC', 'Sucre', 'Department',NULL),
('CO-TOL', 'CO', 'TOL', 'Tolima', 'Department',NULL),
('CO-VAC', 'CO', 'VAC', 'Valle del Cauca', 'Department',NULL),
('CO-VAU', 'CO', 'VAU', 'Vaupés', 'Department',NULL),
('CO-VID', 'CO', 'VID', 'Vichada', 'Department',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('KM', 'COM', 'Comoros', '', 'Union of the Comoros');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('KM-A', 'KM', 'A', 'Andjouân (Anjwān)', 'Island',NULL),
('KM-G', 'KM', 'G', 'Andjazîdja (Anjazījah)', 'Island',NULL),
('KM-M', 'KM', 'M', 'Moûhîlî (Mūhīlī)', 'Island',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('CG', 'COG', 'Congo', '', 'Republic of the Congo');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('CG-11', 'CG', '11', 'Bouenza', 'Region',NULL),
('CG-8', 'CG', '8', 'Cuvette', 'Region',NULL),
('CG-15', 'CG', '15', 'Cuvette-Ouest', 'Region',NULL),
('CG-5', 'CG', '5', 'Kouilou', 'Region',NULL),
('CG-2', 'CG', '2', 'Lékoumou', 'Region',NULL),
('CG-7', 'CG', '7', 'Likouala', 'Region',NULL),
('CG-9', 'CG', '9', 'Niari', 'Region',NULL),
('CG-14', 'CG', '14', 'Plateaux', 'Region',NULL),
('CG-12', 'CG', '12', 'Pool', 'Region',NULL),
('CG-13', 'CG', '13', 'Sangha', 'Region',NULL),
('CG-BZV', 'CG', 'BZV', 'Brazzaville', 'Capital District',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('CD', 'COD', 'Congo, The Democratic Republic of the', '', '');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('CD-KN', 'CD', 'KN', 'Kinshasa', 'City',NULL),
('CD-BN', 'CD', 'BN', 'Bandundu', 'Province',NULL),
('CD-BC', 'CD', 'BC', 'Bas-Congo', 'Province',NULL),
('CD-EQ', 'CD', 'EQ', 'Équateur', 'Province',NULL),
('CD-KW', 'CD', 'KW', 'Kasai-Occidental', 'Province',NULL),
('CD-KE', 'CD', 'KE', 'Kasai-Oriental', 'Province',NULL),
('CD-KA', 'CD', 'KA', 'Katanga', 'Province',NULL),
('CD-MA', 'CD', 'MA', 'Maniema', 'Province',NULL),
('CD-NK', 'CD', 'NK', 'Nord-Kivu', 'Province',NULL),
('CD-OR', 'CD', 'OR', 'Orientale', 'Province',NULL),
('CD-SK', 'CD', 'SK', 'Sud-Kivu', 'Province',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('CK', 'COK', 'Cook Islands', '', '');

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('CR', 'CRI', 'Costa Rica', '', 'Republic of Costa Rica');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('CR-A', 'CR', 'A', 'Alajuela', 'Province',NULL),
('CR-C', 'CR', 'C', 'Cartago', 'Province',NULL),
('CR-G', 'CR', 'G', 'Guanacaste', 'Province',NULL),
('CR-H', 'CR', 'H', 'Heredia', 'Province',NULL),
('CR-L', 'CR', 'L', 'Limón', 'Province',NULL),
('CR-P', 'CR', 'P', 'Puntarenas', 'Province',NULL),
('CR-SJ', 'CR', 'SJ', 'San José', 'Province',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('CI', 'CIV', 'Côte d''Ivoire', '', 'Republic of Côte d''Ivoire');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('CI-06', 'CI', '06', '18 Montagnes (Région des)', 'Region',NULL),
('CI-16', 'CI', '16', 'Agnébi (Région de l'')', 'Region',NULL),
('CI-17', 'CI', '17', 'Bafing (Région du)', 'Region',NULL),
('CI-09', 'CI', '09', 'Bas-Sassandra (Région du)', 'Region',NULL),
('CI-10', 'CI', '10', 'Denguélé (Région du)', 'Region',NULL),
('CI-18', 'CI', '18', 'Fromager (Région du)', 'Region',NULL),
('CI-02', 'CI', '02', 'Haut-Sassandra (Région du)', 'Region',NULL),
('CI-07', 'CI', '07', 'Lacs (Région des)', 'Region',NULL),
('CI-01', 'CI', '01', 'Lagunes (Région des)', 'Region',NULL),
('CI-12', 'CI', '12', 'Marahoué (Région de la)', 'Region',NULL),
('CI-19', 'CI', '19', 'Moyen-Cavally (Région du)', 'Region',NULL),
('CI-05', 'CI', '05', 'Moyen-Comoé (Région du)', 'Region',NULL),
('CI-11', 'CI', '11', 'Nzi-Comoé (Région)', 'Region',NULL),
('CI-03', 'CI', '03', 'Savanes (Région des)', 'Region',NULL),
('CI-15', 'CI', '15', 'Sud-Bandama (Région du)', 'Region',NULL),
('CI-13', 'CI', '13', 'Sud-Comoé (Région du)', 'Region',NULL),
('CI-04', 'CI', '04', 'Vallée du Bandama (Région de la)', 'Region',NULL),
('CI-14', 'CI', '14', 'Worodouqou (Région du)', 'Region',NULL),
('CI-08', 'CI', '08', 'Zanzan (Région du)', 'Region',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('HR', 'HRV', 'Croatia', '', 'Republic of Croatia');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('HR-21', 'HR', '21', 'Grad Zagreb', 'City',NULL),
('HR-07', 'HR', '07', 'Bjelovarsko-bilogorska županija', 'County',NULL),
('HR-12', 'HR', '12', 'Brodsko-posavska županija', 'County',NULL),
('HR-19', 'HR', '19', 'Dubrovačko-neretvanska županija', 'County',NULL),
('HR-18', 'HR', '18', 'Istarska županija', 'County',NULL),
('HR-04', 'HR', '04', 'Karlovačka županija', 'County',NULL),
('HR-06', 'HR', '06', 'Koprivničko-križevačka županija', 'County',NULL),
('HR-02', 'HR', '02', 'Krapinsko-zagorska županija', 'County',NULL),
('HR-09', 'HR', '09', 'Ličko-senjska županija', 'County',NULL),
('HR-20', 'HR', '20', 'Međimurska županija', 'County',NULL),
('HR-14', 'HR', '14', 'Osječko-baranjska županija', 'County',NULL),
('HR-11', 'HR', '11', 'Požeško-slavonska županija', 'County',NULL),
('HR-08', 'HR', '08', 'Primorsko-goranska županija', 'County',NULL),
('HR-03', 'HR', '03', 'Sisačko-moslavačka županija', 'County',NULL),
('HR-17', 'HR', '17', 'Splitsko-dalmatinska županija', 'County',NULL),
('HR-15', 'HR', '15', 'Šibensko-kninska županija', 'County',NULL),
('HR-05', 'HR', '05', 'Varaždinska županija', 'County',NULL),
('HR-10', 'HR', '10', 'Virovitičko-podravska županija', 'County',NULL),
('HR-16', 'HR', '16', 'Vukovarsko-srijemska županija', 'County',NULL),
('HR-13', 'HR', '13', 'Zadarska županija', 'County',NULL),
('HR-01', 'HR', '01', 'Zagrebačka županija', 'County',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('CU', 'CUB', 'Cuba', '', 'Republic of Cuba');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('CU-09', 'CU', '09', 'Camagüey', 'Province',NULL),
('CU-08', 'CU', '08', 'Ciego de Ávila', 'Province',NULL),
('CU-06', 'CU', '06', 'Cienfuegos', 'Province',NULL),
('CU-03', 'CU', '03', 'Ciudad de La Habana', 'Province',NULL),
('CU-12', 'CU', '12', 'Granma', 'Province',NULL),
('CU-14', 'CU', '14', 'Guantánamo', 'Province',NULL),
('CU-11', 'CU', '11', 'Holguín', 'Province',NULL),
('CU-02', 'CU', '02', 'La Habana', 'Province',NULL),
('CU-10', 'CU', '10', 'Las Tunas', 'Province',NULL),
('CU-04', 'CU', '04', 'Matanzas', 'Province',NULL),
('CU-01', 'CU', '01', 'Pinar del Rio', 'Province',NULL),
('CU-07', 'CU', '07', 'Sancti Spíritus', 'Province',NULL),
('CU-13', 'CU', '13', 'Santiago de Cuba', 'Province',NULL),
('CU-05', 'CU', '05', 'Villa Clara', 'Province',NULL),
('CU-99', 'CU', '99', 'Isla de la Juventud', 'Special municipality',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('CW', 'CUW', 'Curaçao', '', 'Curaçao');

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('CY', 'CYP', 'Cyprus', '', 'Republic of Cyprus');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('CY-04', 'CY', '04', 'Ammóchostos', 'District',NULL),
('CY-06', 'CY', '06', 'Kerýneia', 'District',NULL),
('CY-03', 'CY', '03', 'Lárnaka', 'District',NULL),
('CY-01', 'CY', '01', 'Lefkosía', 'District',NULL),
('CY-02', 'CY', '02', 'Lemesós', 'District',NULL),
('CY-05', 'CY', '05', 'Páfos', 'District',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('CZ', 'CZE', 'Czech Republic', '', '');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('CZ-JC', 'CZ', 'JC', 'Jihočeský kraj', 'Region',NULL),
('CZ-JM', 'CZ', 'JM', 'Jihomoravský kraj', 'Region',NULL),
('CZ-KA', 'CZ', 'KA', 'Karlovarský kraj', 'Region',NULL),
('CZ-KR', 'CZ', 'KR', 'Královéhradecký kraj', 'Region',NULL),
('CZ-LI', 'CZ', 'LI', 'Liberecký kraj', 'Region',NULL),
('CZ-MO', 'CZ', 'MO', 'Moravskoslezský kraj', 'Region',NULL),
('CZ-OL', 'CZ', 'OL', 'Olomoucký kraj', 'Region',NULL),
('CZ-PA', 'CZ', 'PA', 'Pardubický kraj', 'Region',NULL),
('CZ-PL', 'CZ', 'PL', 'Plzeňský kraj', 'Region',NULL),
('CZ-PR', 'CZ', 'PR', 'Praha, hlavní město', 'Region',NULL),
('CZ-ST', 'CZ', 'ST', 'Středočeský kraj', 'Region',NULL),
('CZ-US', 'CZ', 'US', 'Ústecký kraj', 'Region',NULL),
('CZ-VY', 'CZ', 'VY', 'Vysočina', 'Region',NULL),
('CZ-ZL', 'CZ', 'ZL', 'Zlínský kraj', 'Region',NULL),
('CZ-201', 'CZ', '201', 'Benešov', 'district','CZ-ST'),
('CZ-202', 'CZ', '202', 'Beroun', 'district','CZ-ST'),
('CZ-621', 'CZ', '621', 'Blansko', 'district','CZ-JM'),
('CZ-622', 'CZ', '622', 'Brno-město', 'district','CZ-JM'),
('CZ-623', 'CZ', '623', 'Brno-venkov', 'district','CZ-JM'),
('CZ-801', 'CZ', '801', 'Bruntál', 'district','CZ-MO'),
('CZ-624', 'CZ', '624', 'Břeclav', 'district','CZ-JM'),
('CZ-511', 'CZ', '511', 'Česká Lípa', 'district','CZ-LI'),
('CZ-311', 'CZ', '311', 'České Budějovice', 'district','CZ-JC'),
('CZ-312', 'CZ', '312', 'Český Krumlov', 'district','CZ-JC'),
('CZ-421', 'CZ', '421', 'Děčín', 'district','CZ-US'),
('CZ-321', 'CZ', '321', 'Domažlice', 'district','CZ-PL'),
('CZ-802', 'CZ', '802', 'Frýdek Místek', 'district','CZ-MO'),
('CZ-611', 'CZ', '611', 'Havlíčkův Brod', 'district','CZ-VY'),
('CZ-625', 'CZ', '625', 'Hodonín', 'district','CZ-JM'),
('CZ-521', 'CZ', '521', 'Hradec Králové', 'district','CZ-KR'),
('CZ-411', 'CZ', '411', 'Cheb', 'district','CZ-KA'),
('CZ-422', 'CZ', '422', 'Chomutov', 'district','CZ-US'),
('CZ-531', 'CZ', '531', 'Chrudim', 'district','CZ-PA'),
('CZ-512', 'CZ', '512', 'Jablonec nad Nisou', 'district','CZ-LI'),
('CZ-711', 'CZ', '711', 'Jeseník', 'district','CZ-OL'),
('CZ-522', 'CZ', '522', 'Jičín', 'district','CZ-KR'),
('CZ-612', 'CZ', '612', 'Jihlava', 'district','CZ-VY'),
('CZ-313', 'CZ', '313', 'Jindřichův Hradec', 'district','CZ-JC'),
('CZ-412', 'CZ', '412', 'Karlovy Vary', 'district','CZ-KA'),
('CZ-803', 'CZ', '803', 'Karviná', 'district','CZ-MO'),
('CZ-203', 'CZ', '203', 'Kladno', 'district','CZ-ST'),
('CZ-322', 'CZ', '322', 'Klatovy', 'district','CZ-PL'),
('CZ-204', 'CZ', '204', 'Kolín', 'district','CZ-ST'),
('CZ-721', 'CZ', '721', 'Kromĕříž', 'district','CZ-ZL'),
('CZ-205', 'CZ', '205', 'Kutná Hora', 'district','CZ-ST'),
('CZ-513', 'CZ', '513', 'Liberec', 'district','CZ-LI'),
('CZ-423', 'CZ', '423', 'Litoměřice', 'district','CZ-US'),
('CZ-424', 'CZ', '424', 'Louny', 'district','CZ-US'),
('CZ-206', 'CZ', '206', 'Mělník', 'district','CZ-ST'),
('CZ-207', 'CZ', '207', 'Mladá Boleslav', 'district','CZ-ST'),
('CZ-425', 'CZ', '425', 'Most', 'district','CZ-US'),
('CZ-523', 'CZ', '523', 'Náchod', 'district','CZ-KR'),
('CZ-804', 'CZ', '804', 'Nový Jičín', 'district','CZ-MO'),
('CZ-208', 'CZ', '208', 'Nymburk', 'district','CZ-ST'),
('CZ-712', 'CZ', '712', 'Olomouc', 'district','CZ-OL'),
('CZ-805', 'CZ', '805', 'Opava', 'district','CZ-MO'),
('CZ-806', 'CZ', '806', 'Ostrava město', 'district','CZ-MO'),
('CZ-532', 'CZ', '532', 'Pardubice', 'district','CZ-PA'),
('CZ-613', 'CZ', '613', 'Pelhřimov', 'district','CZ-VY'),
('CZ-314', 'CZ', '314', 'Písek', 'district','CZ-JC'),
('CZ-324', 'CZ', '324', 'Plzeň jih', 'district','CZ-PL'),
('CZ-323', 'CZ', '323', 'Plzeň město', 'district','CZ-PL'),
('CZ-325', 'CZ', '325', 'Plzeň sever', 'district','CZ-PL'),
('CZ-101', 'CZ', '101', 'Praha 1', 'district','CZ-PR'),
('CZ-102', 'CZ', '102', 'Praha 2', 'district','CZ-PR'),
('CZ-103', 'CZ', '103', 'Praha 3', 'district','CZ-PR'),
('CZ-104', 'CZ', '104', 'Praha 4', 'district','CZ-PR'),
('CZ-105', 'CZ', '105', 'Praha 5', 'district','CZ-PR'),
('CZ-106', 'CZ', '106', 'Praha 6', 'district','CZ-PR'),
('CZ-107', 'CZ', '107', 'Praha 7', 'district','CZ-PR'),
('CZ-108', 'CZ', '108', 'Praha 8', 'district','CZ-PR'),
('CZ-109', 'CZ', '109', 'Praha 9', 'district','CZ-PR'),
('CZ-10A', 'CZ', '10A', 'Praha 10', 'district','CZ-PR'),
('CZ-10B', 'CZ', '10B', 'Praha 11', 'district','CZ-PR'),
('CZ-10C', 'CZ', '10C', 'Praha 12', 'district','CZ-PR'),
('CZ-10D', 'CZ', '10D', 'Praha 13', 'district','CZ-PR'),
('CZ-10E', 'CZ', '10E', 'Praha 14', 'district','CZ-PR'),
('CZ-10F', 'CZ', '10F', 'Praha 15', 'district','CZ-PR'),
('CZ-209', 'CZ', '209', 'Praha východ', 'district','CZ-ST'),
('CZ-20A', 'CZ', '20A', 'Praha západ', 'district','CZ-ST'),
('CZ-315', 'CZ', '315', 'Prachatice', 'district','CZ-JC'),
('CZ-713', 'CZ', '713', 'Prostĕjov', 'district','CZ-OL'),
('CZ-714', 'CZ', '714', 'Přerov', 'district','CZ-OL'),
('CZ-20B', 'CZ', '20B', 'Příbram', 'district','CZ-ST'),
('CZ-20C', 'CZ', '20C', 'Rakovník', 'district','CZ-ST'),
('CZ-326', 'CZ', '326', 'Rokycany', 'district','CZ-PL'),
('CZ-524', 'CZ', '524', 'Rychnov nad Kněžnou', 'district','CZ-KR'),
('CZ-514', 'CZ', '514', 'Semily', 'district','CZ-LI'),
('CZ-413', 'CZ', '413', 'Sokolov', 'district','CZ-KA'),
('CZ-316', 'CZ', '316', 'Strakonice', 'district','CZ-JC'),
('CZ-533', 'CZ', '533', 'Svitavy', 'district','CZ-PA'),
('CZ-715', 'CZ', '715', 'Šumperk', 'district','CZ-OL'),
('CZ-317', 'CZ', '317', 'Tábor', 'district','CZ-JC'),
('CZ-327', 'CZ', '327', 'Tachov', 'district','CZ-PL'),
('CZ-426', 'CZ', '426', 'Teplice', 'district','CZ-US'),
('CZ-525', 'CZ', '525', 'Trutnov', 'district','CZ-KR'),
('CZ-614', 'CZ', '614', 'Třebíč', 'district','CZ-VY'),
('CZ-722', 'CZ', '722', 'Uherské Hradištĕ', 'district','CZ-ZL'),
('CZ-427', 'CZ', '427', 'Ústí nad Labem', 'district','CZ-US'),
('CZ-534', 'CZ', '534', 'Ústí nad Orlicí', 'district','CZ-PA'),
('CZ-723', 'CZ', '723', 'Vsetín', 'district','CZ-ZL'),
('CZ-626', 'CZ', '626', 'Vyškov', 'district','CZ-JM'),
('CZ-724', 'CZ', '724', 'Zlín', 'district','CZ-ZL'),
('CZ-627', 'CZ', '627', 'Znojmo', 'district','CZ-JM'),
('CZ-615', 'CZ', '615', 'Žd’ár nad Sázavou', 'district','CZ-VY');

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('DK', 'DNK', 'Denmark', '', 'Kingdom of Denmark');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('DK-84', 'DK', '84', 'Hovedstaden', 'Region',NULL),
('DK-82', 'DK', '82', 'Midtjylland', 'Region',NULL),
('DK-81', 'DK', '81', 'Nordjylland', 'Region',NULL),
('DK-85', 'DK', '85', 'Sjælland', 'Region',NULL),
('DK-83', 'DK', '83', 'Syddanmark', 'Region',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('DJ', 'DJI', 'Djibouti', '', 'Republic of Djibouti');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('DJ-AS', 'DJ', 'AS', 'Ali Sabieh', 'Region',NULL),
('DJ-AR', 'DJ', 'AR', 'Arta', 'Region',NULL),
('DJ-DI', 'DJ', 'DI', 'Dikhil', 'Region',NULL),
('DJ-OB', 'DJ', 'OB', 'Obock', 'Region',NULL),
('DJ-TA', 'DJ', 'TA', 'Tadjourah', 'Region',NULL),
('DJ-DJ', 'DJ', 'DJ', 'Djibouti', 'City',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('DM', 'DMA', 'Dominica', '', 'Commonwealth of Dominica');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('DM-02', 'DM', '02', 'Saint Andrew', 'Parish',NULL),
('DM-03', 'DM', '03', 'Saint David', 'Parish',NULL),
('DM-04', 'DM', '04', 'Saint George', 'Parish',NULL),
('DM-05', 'DM', '05', 'Saint John', 'Parish',NULL),
('DM-06', 'DM', '06', 'Saint Joseph', 'Parish',NULL),
('DM-07', 'DM', '07', 'Saint Luke', 'Parish',NULL),
('DM-08', 'DM', '08', 'Saint Mark', 'Parish',NULL),
('DM-09', 'DM', '09', 'Saint Patrick', 'Parish',NULL),
('DM-10', 'DM', '10', 'Saint Paul', 'Parish',NULL),
('DM-01', 'DM', '01', 'Saint Peter', 'Parish',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('DO', 'DOM', 'Dominican Republic', '', '');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('DO-01', 'DO', '01', 'Distrito Nacional (Santo Domingo)', 'District',NULL),
('DO-02', 'DO', '02', 'Azua', 'Province',NULL),
('DO-03', 'DO', '03', 'Bahoruco', 'Province',NULL),
('DO-04', 'DO', '04', 'Barahona', 'Province',NULL),
('DO-05', 'DO', '05', 'Dajabón', 'Province',NULL),
('DO-06', 'DO', '06', 'Duarte', 'Province',NULL),
('DO-08', 'DO', '08', 'El Seybo [El Seibo]', 'Province',NULL),
('DO-09', 'DO', '09', 'Espaillat', 'Province',NULL),
('DO-30', 'DO', '30', 'Hato Mayor', 'Province',NULL),
('DO-10', 'DO', '10', 'Independencia', 'Province',NULL),
('DO-11', 'DO', '11', 'La Altagracia', 'Province',NULL),
('DO-07', 'DO', '07', 'La Estrelleta [Elías Piña]', 'Province',NULL),
('DO-12', 'DO', '12', 'La Romana', 'Province',NULL),
('DO-13', 'DO', '13', 'La Vega', 'Province',NULL),
('DO-14', 'DO', '14', 'María Trinidad Sánchez', 'Province',NULL),
('DO-28', 'DO', '28', 'Monseñor Nouel', 'Province',NULL),
('DO-15', 'DO', '15', 'Monte Cristi', 'Province',NULL),
('DO-29', 'DO', '29', 'Monte Plata', 'Province',NULL),
('DO-16', 'DO', '16', 'Pedernales', 'Province',NULL),
('DO-17', 'DO', '17', 'Peravia', 'Province',NULL),
('DO-18', 'DO', '18', 'Puerto Plata', 'Province',NULL),
('DO-19', 'DO', '19', 'Salcedo', 'Province',NULL),
('DO-20', 'DO', '20', 'Samaná', 'Province',NULL),
('DO-21', 'DO', '21', 'San Cristóbal', 'Province',NULL),
('DO-22', 'DO', '22', 'San Juan', 'Province',NULL),
('DO-23', 'DO', '23', 'San Pedro de Macorís', 'Province',NULL),
('DO-24', 'DO', '24', 'Sánchez Ramírez', 'Province',NULL),
('DO-25', 'DO', '25', 'Santiago', 'Province',NULL),
('DO-26', 'DO', '26', 'Santiago Rodríguez', 'Province',NULL),
('DO-27', 'DO', '27', 'Valverde', 'Province',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('EC', 'ECU', 'Ecuador', '', 'Republic of Ecuador');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('EC-A', 'EC', 'A', 'Azuay', 'Province',NULL),
('EC-B', 'EC', 'B', 'Bolívar', 'Province',NULL),
('EC-F', 'EC', 'F', 'Cañar', 'Province',NULL),
('EC-C', 'EC', 'C', 'Carchi', 'Province',NULL),
('EC-X', 'EC', 'X', 'Cotopaxi', 'Province',NULL),
('EC-H', 'EC', 'H', 'Chimborazo', 'Province',NULL),
('EC-O', 'EC', 'O', 'El Oro', 'Province',NULL),
('EC-E', 'EC', 'E', 'Esmeraldas', 'Province',NULL),
('EC-W', 'EC', 'W', 'Galápagos', 'Province',NULL),
('EC-G', 'EC', 'G', 'Guayas', 'Province',NULL),
('EC-I', 'EC', 'I', 'Imbabura', 'Province',NULL),
('EC-L', 'EC', 'L', 'Loja', 'Province',NULL),
('EC-R', 'EC', 'R', 'Los Ríos', 'Province',NULL),
('EC-M', 'EC', 'M', 'Manabí', 'Province',NULL),
('EC-S', 'EC', 'S', 'Morona-Santiago', 'Province',NULL),
('EC-N', 'EC', 'N', 'Napo', 'Province',NULL),
('EC-D', 'EC', 'D', 'Orellana', 'Province',NULL),
('EC-Y', 'EC', 'Y', 'Pastaza', 'Province',NULL),
('EC-P', 'EC', 'P', 'Pichincha', 'Province',NULL),
('EC-SE', 'EC', 'SE', 'Santa Elena', 'Province',NULL),
('EC-SD', 'EC', 'SD', 'Santo Domingo de los Tsáchilas', 'Province',NULL),
('EC-U', 'EC', 'U', 'Sucumbíos', 'Province',NULL),
('EC-T', 'EC', 'T', 'Tungurahua', 'Province',NULL),
('EC-Z', 'EC', 'Z', 'Zamora-Chinchipe', 'Province',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('EG', 'EGY', 'Egypt', '', 'Arab Republic of Egypt');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('EG-DK', 'EG', 'DK', 'Ad Daqahlīyah', 'Governorate',NULL),
('EG-BA', 'EG', 'BA', 'Al Bahr al Ahmar', 'Governorate',NULL),
('EG-BH', 'EG', 'BH', 'Al Buhayrah', 'Governorate',NULL),
('EG-FYM', 'EG', 'FYM', 'Al Fayyūm', 'Governorate',NULL),
('EG-GH', 'EG', 'GH', 'Al Gharbīyah', 'Governorate',NULL),
('EG-ALX', 'EG', 'ALX', 'Al Iskandarīyah', 'Governorate',NULL),
('EG-IS', 'EG', 'IS', 'Al Ismā`īlīyah', 'Governorate',NULL),
('EG-GZ', 'EG', 'GZ', 'Al Jīzah', 'Governorate',NULL),
('EG-MNF', 'EG', 'MNF', 'Al Minūfīyah', 'Governorate',NULL),
('EG-MN', 'EG', 'MN', 'Al Minyā', 'Governorate',NULL),
('EG-C', 'EG', 'C', 'Al Qāhirah', 'Governorate',NULL),
('EG-KB', 'EG', 'KB', 'Al Qalyūbīyah', 'Governorate',NULL),
('EG-WAD', 'EG', 'WAD', 'Al Wādī al Jadīd', 'Governorate',NULL),
('EG-SU', 'EG', 'SU', 'As Sādis min Uktūbar', 'Governorate',NULL),
('EG-SHR', 'EG', 'SHR', 'Ash Sharqīyah', 'Governorate',NULL),
('EG-SUZ', 'EG', 'SUZ', 'As Suways', 'Governorate',NULL),
('EG-ASN', 'EG', 'ASN', 'Aswān', 'Governorate',NULL),
('EG-AST', 'EG', 'AST', 'Asyūt', 'Governorate',NULL),
('EG-BNS', 'EG', 'BNS', 'Banī Suwayf', 'Governorate',NULL),
('EG-PTS', 'EG', 'PTS', 'Būr Sa`īd', 'Governorate',NULL),
('EG-DT', 'EG', 'DT', 'Dumyāt', 'Governorate',NULL),
('EG-HU', 'EG', 'HU', 'Ḩulwān', 'Governorate',NULL),
('EG-JS', 'EG', 'JS', 'Janūb Sīnā''', 'Governorate',NULL),
('EG-KFS', 'EG', 'KFS', 'Kafr ash Shaykh', 'Governorate',NULL),
('EG-MT', 'EG', 'MT', 'Matrūh', 'Governorate',NULL),
('EG-KN', 'EG', 'KN', 'Qinā', 'Governorate',NULL),
('EG-SIN', 'EG', 'SIN', 'Shamal Sīnā''', 'Governorate',NULL),
('EG-SHG', 'EG', 'SHG', 'Sūhāj', 'Governorate',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('SV', 'SLV', 'El Salvador', '', 'Republic of El Salvador');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('SV-AH', 'SV', 'AH', 'Ahuachapán', 'Department',NULL),
('SV-CA', 'SV', 'CA', 'Cabañas', 'Department',NULL),
('SV-CU', 'SV', 'CU', 'Cuscatlán', 'Department',NULL),
('SV-CH', 'SV', 'CH', 'Chalatenango', 'Department',NULL),
('SV-LI', 'SV', 'LI', 'La Libertad', 'Department',NULL),
('SV-PA', 'SV', 'PA', 'La Paz', 'Department',NULL),
('SV-UN', 'SV', 'UN', 'La Unión', 'Department',NULL),
('SV-MO', 'SV', 'MO', 'Morazán', 'Department',NULL),
('SV-SM', 'SV', 'SM', 'San Miguel', 'Department',NULL),
('SV-SS', 'SV', 'SS', 'San Salvador', 'Department',NULL),
('SV-SA', 'SV', 'SA', 'Santa Ana', 'Department',NULL),
('SV-SV', 'SV', 'SV', 'San Vicente', 'Department',NULL),
('SV-SO', 'SV', 'SO', 'Sonsonate', 'Department',NULL),
('SV-US', 'SV', 'US', 'Usulután', 'Department',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('GQ', 'GNQ', 'Equatorial Guinea', '', 'Republic of Equatorial Guinea');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('GQ-C', 'GQ', 'C', 'Región Continental', 'Region',NULL),
('GQ-I', 'GQ', 'I', 'Región Insular', 'Region',NULL),
('GQ-AN', 'GQ', 'AN', 'Annobón', 'Province','GQ-I'),
('GQ-BN', 'GQ', 'BN', 'Bioko Norte', 'Province','GQ-I'),
('GQ-BS', 'GQ', 'BS', 'Bioko Sur', 'Province','GQ-I'),
('GQ-CS', 'GQ', 'CS', 'Centro Sur', 'Province','GQ-C'),
('GQ-KN', 'GQ', 'KN', 'Kié-Ntem', 'Province','GQ-C'),
('GQ-LI', 'GQ', 'LI', 'Litoral', 'Province','GQ-C'),
('GQ-WN', 'GQ', 'WN', 'Wele-Nzas', 'Province','GQ-C');

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('ER', 'ERI', 'Eritrea', '', 'the State of Eritrea');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('ER-MA', 'ER', 'MA', 'Al Awsaţ', 'Province',NULL),
('ER-DU', 'ER', 'DU', 'Al Janūbī', 'Province',NULL),
('ER-AN', 'ER', 'AN', 'Ansabā', 'Province',NULL),
('ER-DK', 'ER', 'DK', 'Janūbī al Baḩrī al Aḩmar', 'Province',NULL),
('ER-GB', 'ER', 'GB', 'Qāsh-Barkah', 'Province',NULL),
('ER-SK', 'ER', 'SK', 'Shimālī al Baḩrī al Aḩmar', 'Province',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('EE', 'EST', 'Estonia', '', 'Republic of Estonia');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('EE-37', 'EE', '37', 'Harjumaa', 'County',NULL),
('EE-39', 'EE', '39', 'Hiiumaa', 'County',NULL),
('EE-44', 'EE', '44', 'Ida-Virumaa', 'County',NULL),
('EE-49', 'EE', '49', 'Jõgevamaa', 'County',NULL),
('EE-51', 'EE', '51', 'Järvamaa', 'County',NULL),
('EE-57', 'EE', '57', 'Läänemaa', 'County',NULL),
('EE-59', 'EE', '59', 'Lääne-Virumaa', 'County',NULL),
('EE-65', 'EE', '65', 'Põlvamaa', 'County',NULL),
('EE-67', 'EE', '67', 'Pärnumaa', 'County',NULL),
('EE-70', 'EE', '70', 'Raplamaa', 'County',NULL),
('EE-74', 'EE', '74', 'Saaremaa', 'County',NULL),
('EE-78', 'EE', '78', 'Tartumaa', 'County',NULL),
('EE-82', 'EE', '82', 'Valgamaa', 'County',NULL),
('EE-84', 'EE', '84', 'Viljandimaa', 'County',NULL),
('EE-86', 'EE', '86', 'Võrumaa', 'County',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('ET', 'ETH', 'Ethiopia', '', 'Federal Democratic Republic of Ethiopia');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('ET-AA', 'ET', 'AA', 'Ādīs Ābeba', 'Administration',NULL),
('ET-DD', 'ET', 'DD', 'Dirē Dawa', 'Administration',NULL),
('ET-AF', 'ET', 'AF', 'Āfar', 'State',NULL),
('ET-AM', 'ET', 'AM', 'Āmara', 'State',NULL),
('ET-BE', 'ET', 'BE', 'Bīnshangul Gumuz', 'State',NULL),
('ET-GA', 'ET', 'GA', 'Gambēla Hizboch', 'State',NULL),
('ET-HA', 'ET', 'HA', 'Hārerī Hizb', 'State',NULL),
('ET-OR', 'ET', 'OR', 'Oromīya', 'State',NULL),
('ET-SO', 'ET', 'SO', 'Sumalē', 'State',NULL),
('ET-TI', 'ET', 'TI', 'Tigray', 'State',NULL),
('ET-SN', 'ET', 'SN', 'YeDebub Bihēroch Bihēreseboch na Hizboch', 'State',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('FK', 'FLK', 'Falkland Islands (Malvinas)', '', '');

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('FO', 'FRO', 'Faroe Islands', '', '');

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('FJ', 'FJI', 'Fiji', '', 'Republic of Fiji');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('FJ-C', 'FJ', 'C', 'Central', 'Division',NULL),
('FJ-E', 'FJ', 'E', 'Eastern', 'Division',NULL),
('FJ-N', 'FJ', 'N', 'Northern', 'Division',NULL),
('FJ-W', 'FJ', 'W', 'Western', 'Division',NULL),
('FJ-R', 'FJ', 'R', 'Rotuma', 'Dependency',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('FI', 'FIN', 'Finland', '', 'Republic of Finland');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('FI-01', 'FI', '01', 'Ahvenanmaan maakunta', 'Region',NULL),
('FI-02', 'FI', '02', 'Etelä-Karjala', 'Region',NULL),
('FI-03', 'FI', '03', 'Etelä-Pohjanmaa', 'Region',NULL),
('FI-04', 'FI', '04', 'Etelä-Savo', 'Region',NULL),
('FI-05', 'FI', '05', 'Kainuu', 'Region',NULL),
('FI-06', 'FI', '06', 'Kanta-Häme', 'Region',NULL),
('FI-07', 'FI', '07', 'Keski-Pohjanmaa', 'Region',NULL),
('FI-08', 'FI', '08', 'Keski-Suomi', 'Region',NULL),
('FI-09', 'FI', '09', 'Kymenlaakso', 'Region',NULL),
('FI-10', 'FI', '10', 'Lappi', 'Region',NULL),
('FI-11', 'FI', '11', 'Pirkanmaa', 'Region',NULL),
('FI-12', 'FI', '12', 'Pohjanmaa', 'Region',NULL),
('FI-13', 'FI', '13', 'Pohjois-Karjala', 'Region',NULL),
('FI-14', 'FI', '14', 'Pohjois-Pohjanmaa', 'Region',NULL),
('FI-15', 'FI', '15', 'Pohjois-Savo', 'Region',NULL),
('FI-16', 'FI', '16', 'Päijät-Häme', 'Region',NULL),
('FI-17', 'FI', '17', 'Satakunta', 'Region',NULL),
('FI-18', 'FI', '18', 'Uusimaa', 'Region',NULL),
('FI-19', 'FI', '19', 'Varsinais-Suomi', 'Region',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('FR', 'FRA', 'France', '', 'French Republic');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('FR-A', 'FR', 'A', 'Alsace', 'Metropolitan region',NULL),
('FR-B', 'FR', 'B', 'Aquitaine', 'Metropolitan region',NULL),
('FR-C', 'FR', 'C', 'Auvergne', 'Metropolitan region',NULL),
('FR-P', 'FR', 'P', 'Basse-Normandie', 'Metropolitan region',NULL),
('FR-D', 'FR', 'D', 'Bourgogne', 'Metropolitan region',NULL),
('FR-E', 'FR', 'E', 'Bretagne', 'Metropolitan region',NULL),
('FR-F', 'FR', 'F', 'Centre', 'Metropolitan region',NULL),
('FR-G', 'FR', 'G', 'Champagne-Ardenne', 'Metropolitan region',NULL),
('FR-H', 'FR', 'H', 'Corse', 'Metropolitan region',NULL),
('FR-I', 'FR', 'I', 'Franche-Comté', 'Metropolitan region',NULL),
('FR-Q', 'FR', 'Q', 'Haute-Normandie', 'Metropolitan region',NULL),
('FR-J', 'FR', 'J', 'Île-de-France', 'Metropolitan region',NULL),
('FR-K', 'FR', 'K', 'Languedoc-Roussillon', 'Metropolitan region',NULL),
('FR-L', 'FR', 'L', 'Limousin', 'Metropolitan region',NULL),
('FR-M', 'FR', 'M', 'Lorraine', 'Metropolitan region',NULL),
('FR-N', 'FR', 'N', 'Midi-Pyrénées', 'Metropolitan region',NULL),
('FR-O', 'FR', 'O', 'Nord - Pas-de-Calais', 'Metropolitan region',NULL),
('FR-R', 'FR', 'R', 'Pays de la Loire', 'Metropolitan region',NULL),
('FR-S', 'FR', 'S', 'Picardie', 'Metropolitan region',NULL),
('FR-T', 'FR', 'T', 'Poitou-Charentes', 'Metropolitan region',NULL),
('FR-U', 'FR', 'U', 'Provence-Alpes-Côte d''Azur', 'Metropolitan region',NULL),
('FR-V', 'FR', 'V', 'Rhône-Alpes', 'Metropolitan region',NULL),
('FR-01', 'FR', '01', 'Ain', 'Metropolitan department','FR-V'),
('FR-02', 'FR', '02', 'Aisne', 'Metropolitan department','FR-S'),
('FR-03', 'FR', '03', 'Allier', 'Metropolitan department','FR-C'),
('FR-04', 'FR', '04', 'Alpes-de-Haute-Provence', 'Metropolitan department','FR-U'),
('FR-06', 'FR', '06', 'Alpes-Maritimes', 'Metropolitan department','FR-U'),
('FR-07', 'FR', '07', 'Ardèche', 'Metropolitan department','FR-V'),
('FR-08', 'FR', '08', 'Ardennes', 'Metropolitan department','FR-G'),
('FR-09', 'FR', '09', 'Ariège', 'Metropolitan department','FR-N'),
('FR-10', 'FR', '10', 'Aube', 'Metropolitan department','FR-G'),
('FR-11', 'FR', '11', 'Aude', 'Metropolitan department','FR-K'),
('FR-12', 'FR', '12', 'Aveyron', 'Metropolitan department','FR-N'),
('FR-67', 'FR', '67', 'Bas-Rhin', 'Metropolitan department','FR-A'),
('FR-13', 'FR', '13', 'Bouches-du-Rhône', 'Metropolitan department','FR-U'),
('FR-14', 'FR', '14', 'Calvados', 'Metropolitan department','FR-P'),
('FR-15', 'FR', '15', 'Cantal', 'Metropolitan department','FR-C'),
('FR-16', 'FR', '16', 'Charente', 'Metropolitan department','FR-T'),
('FR-17', 'FR', '17', 'Charente-Maritime', 'Metropolitan department','FR-T'),
('FR-18', 'FR', '18', 'Cher', 'Metropolitan department','FR-F'),
('FR-19', 'FR', '19', 'Corrèze', 'Metropolitan department','FR-L'),
('FR-2A', 'FR', '2A', 'Corse-du-Sud', 'Metropolitan department','FR-H'),
('FR-21', 'FR', '21', 'Côte-d''Or', 'Metropolitan department','FR-D'),
('FR-22', 'FR', '22', 'Côtes-d''Armor', 'Metropolitan department','FR-E'),
('FR-23', 'FR', '23', 'Creuse', 'Metropolitan department','FR-L'),
('FR-79', 'FR', '79', 'Deux-Sèvres', 'Metropolitan department','FR-T'),
('FR-24', 'FR', '24', 'Dordogne', 'Metropolitan department','FR-B'),
('FR-25', 'FR', '25', 'Doubs', 'Metropolitan department','FR-I'),
('FR-26', 'FR', '26', 'Drôme', 'Metropolitan department','FR-V'),
('FR-91', 'FR', '91', 'Essonne', 'Metropolitan department','FR-J'),
('FR-27', 'FR', '27', 'Eure', 'Metropolitan department','FR-Q'),
('FR-28', 'FR', '28', 'Eure-et-Loir', 'Metropolitan department','FR-F'),
('FR-29', 'FR', '29', 'Finistère', 'Metropolitan department','FR-E'),
('FR-30', 'FR', '30', 'Gard', 'Metropolitan department','FR-K'),
('FR-32', 'FR', '32', 'Gers', 'Metropolitan department','FR-N'),
('FR-33', 'FR', '33', 'Gironde', 'Metropolitan department','FR-B'),
('FR-2B', 'FR', '2B', 'Haute-Corse', 'Metropolitan department','FR-H'),
('FR-31', 'FR', '31', 'Haute-Garonne', 'Metropolitan department','FR-N'),
('FR-43', 'FR', '43', 'Haute-Loire', 'Metropolitan department','FR-C'),
('FR-52', 'FR', '52', 'Haute-Marne', 'Metropolitan department','FR-G'),
('FR-05', 'FR', '05', 'Hautes-Alpes', 'Metropolitan department','FR-U'),
('FR-70', 'FR', '70', 'Haute-Saône', 'Metropolitan department','FR-I'),
('FR-74', 'FR', '74', 'Haute-Savoie', 'Metropolitan department','FR-V'),
('FR-65', 'FR', '65', 'Hautes-Pyrénées', 'Metropolitan department','FR-N'),
('FR-87', 'FR', '87', 'Haute-Vienne', 'Metropolitan department','FR-L'),
('FR-68', 'FR', '68', 'Haut-Rhin', 'Metropolitan department','FR-A'),
('FR-92', 'FR', '92', 'Hauts-de-Seine', 'Metropolitan department','FR-J'),
('FR-34', 'FR', '34', 'Hérault', 'Metropolitan department','FR-K'),
('FR-35', 'FR', '35', 'Ille-et-Vilaine', 'Metropolitan department','FR-E'),
('FR-36', 'FR', '36', 'Indre', 'Metropolitan department','FR-F'),
('FR-37', 'FR', '37', 'Indre-et-Loire', 'Metropolitan department','FR-F'),
('FR-38', 'FR', '38', 'Isère', 'Metropolitan department','FR-V'),
('FR-39', 'FR', '39', 'Jura', 'Metropolitan department','FR-I'),
('FR-40', 'FR', '40', 'Landes', 'Metropolitan department','FR-B'),
('FR-41', 'FR', '41', 'Loir-et-Cher', 'Metropolitan department','FR-F'),
('FR-42', 'FR', '42', 'Loire', 'Metropolitan department','FR-V'),
('FR-44', 'FR', '44', 'Loire-Atlantique', 'Metropolitan department','FR-R'),
('FR-45', 'FR', '45', 'Loiret', 'Metropolitan department','FR-F'),
('FR-46', 'FR', '46', 'Lot', 'Metropolitan department','FR-N'),
('FR-47', 'FR', '47', 'Lot-et-Garonne', 'Metropolitan department','FR-B'),
('FR-48', 'FR', '48', 'Lozère', 'Metropolitan department','FR-K'),
('FR-49', 'FR', '49', 'Maine-et-Loire', 'Metropolitan department','FR-R'),
('FR-50', 'FR', '50', 'Manche', 'Metropolitan department','FR-P'),
('FR-51', 'FR', '51', 'Marne', 'Metropolitan department','FR-G'),
('FR-53', 'FR', '53', 'Mayenne', 'Metropolitan department','FR-R'),
('FR-54', 'FR', '54', 'Meurthe-et-Moselle', 'Metropolitan department','FR-M'),
('FR-55', 'FR', '55', 'Meuse', 'Metropolitan department','FR-M'),
('FR-56', 'FR', '56', 'Morbihan', 'Metropolitan department','FR-E'),
('FR-57', 'FR', '57', 'Moselle', 'Metropolitan department','FR-M'),
('FR-58', 'FR', '58', 'Nièvre', 'Metropolitan department','FR-D'),
('FR-59', 'FR', '59', 'Nord', 'Metropolitan department','FR-O'),
('FR-60', 'FR', '60', 'Oise', 'Metropolitan department','FR-S'),
('FR-61', 'FR', '61', 'Orne', 'Metropolitan department','FR-P'),
('FR-75', 'FR', '75', 'Paris', 'Metropolitan department','FR-J'),
('FR-62', 'FR', '62', 'Pas-de-Calais', 'Metropolitan department','FR-O'),
('FR-63', 'FR', '63', 'Puy-de-Dôme', 'Metropolitan department','FR-C'),
('FR-64', 'FR', '64', 'Pyrénées-Atlantiques', 'Metropolitan department','FR-B'),
('FR-66', 'FR', '66', 'Pyrénées-Orientales', 'Metropolitan department','FR-K'),
('FR-69', 'FR', '69', 'Rhône', 'Metropolitan department','FR-V'),
('FR-71', 'FR', '71', 'Saône-et-Loire', 'Metropolitan department','FR-D'),
('FR-72', 'FR', '72', 'Sarthe', 'Metropolitan department','FR-R'),
('FR-73', 'FR', '73', 'Savoie', 'Metropolitan department','FR-V'),
('FR-77', 'FR', '77', 'Seine-et-Marne', 'Metropolitan department','FR-J'),
('FR-76', 'FR', '76', 'Seine-Maritime', 'Metropolitan department','FR-Q'),
('FR-93', 'FR', '93', 'Seine-Saint-Denis', 'Metropolitan department','FR-J'),
('FR-80', 'FR', '80', 'Somme', 'Metropolitan department','FR-S'),
('FR-81', 'FR', '81', 'Tarn', 'Metropolitan department','FR-N'),
('FR-82', 'FR', '82', 'Tarn-et-Garonne', 'Metropolitan department','FR-N'),
('FR-90', 'FR', '90', 'Territoire de Belfort', 'Metropolitan department','FR-I'),
('FR-94', 'FR', '94', 'Val-de-Marne', 'Metropolitan department','FR-J'),
('FR-95', 'FR', '95', 'Val d''Oise', 'Metropolitan department','FR-J'),
('FR-83', 'FR', '83', 'Var', 'Metropolitan department','FR-U'),
('FR-84', 'FR', '84', 'Vaucluse', 'Metropolitan department','FR-U'),
('FR-85', 'FR', '85', 'Vendée', 'Metropolitan department','FR-R'),
('FR-86', 'FR', '86', 'Vienne', 'Metropolitan department','FR-T'),
('FR-88', 'FR', '88', 'Vosges', 'Metropolitan department','FR-M'),
('FR-89', 'FR', '89', 'Yonne', 'Metropolitan department','FR-D'),
('FR-78', 'FR', '78', 'Yvelines', 'Metropolitan department','FR-J'),
('FR-GP', 'FR', 'GP', 'Guadeloupe', 'Overseas region/department',NULL),
('FR-GF', 'FR', 'GF', 'Guyane', 'Overseas region/department',NULL),
('FR-MQ', 'FR', 'MQ', 'Martinique', 'Overseas region/department',NULL),
('FR-YT', 'FR', 'YT', 'Mayotte', 'Overseas region/department',NULL),
('FR-RE', 'FR', 'RE', 'Réunion', 'Overseas region/department',NULL),
('FR-CP', 'FR', 'CP', 'Clipperton', 'Dependency',NULL),
('FR-NC', 'FR', 'NC', 'Nouvelle-Calédonie', 'Overseas territorial collectivity',NULL),
('FR-PF', 'FR', 'PF', 'Polynésie française', 'Overseas territorial collectivity',NULL),
('FR-BL', 'FR', 'BL', 'Saint-Barthélemy', 'Overseas territorial collectivity',NULL),
('FR-MF', 'FR', 'MF', 'Saint-Martin', 'Overseas territorial collectivity',NULL),
('FR-PM', 'FR', 'PM', 'Saint-Pierre-et-Miquelon', 'Overseas territorial collectivity',NULL),
('FR-TF', 'FR', 'TF', 'Terres australes françaises', 'Overseas territorial collectivity',NULL),
('FR-WF', 'FR', 'WF', 'Wallis-et-Futuna', 'Overseas territorial collectivity',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('GF', 'GUF', 'French Guiana', '', '');

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('PF', 'PYF', 'French Polynesia', '', '');

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('TF', 'ATF', 'French Southern Territories', '', '');

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('GA', 'GAB', 'Gabon', '', 'Gabonese Republic');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('GA-1', 'GA', '1', 'Estuaire', 'Province',NULL),
('GA-2', 'GA', '2', 'Haut-Ogooué', 'Province',NULL),
('GA-3', 'GA', '3', 'Moyen-Ogooué', 'Province',NULL),
('GA-4', 'GA', '4', 'Ngounié', 'Province',NULL),
('GA-5', 'GA', '5', 'Nyanga', 'Province',NULL),
('GA-6', 'GA', '6', 'Ogooué-Ivindo', 'Province',NULL),
('GA-7', 'GA', '7', 'Ogooué-Lolo', 'Province',NULL),
('GA-8', 'GA', '8', 'Ogooué-Maritime', 'Province',NULL),
('GA-9', 'GA', '9', 'Woleu-Ntem', 'Province',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('GM', 'GMB', 'Gambia', '', 'Republic of the Gambia');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('GM-L', 'GM', 'L', 'Lower River', 'Division',NULL),
('GM-M', 'GM', 'M', 'Central River', 'Division',NULL),
('GM-N', 'GM', 'N', 'North Bank', 'Division',NULL),
('GM-U', 'GM', 'U', 'Upper River', 'Division',NULL),
('GM-W', 'GM', 'W', 'Western', 'Division',NULL),
('GM-B', 'GM', 'B', 'Banjul', 'City',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('GE', 'GEO', 'Georgia', '', '');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('GE-AB', 'GE', 'AB', 'Abkhazia', 'Autonomous republic',NULL),
('GE-AJ', 'GE', 'AJ', 'Ajaria', 'Autonomous republic',NULL),
('GE-TB', 'GE', 'TB', 'T’bilisi', 'City',NULL),
('GE-GU', 'GE', 'GU', 'Guria', 'Region',NULL),
('GE-IM', 'GE', 'IM', 'Imeret’i', 'Region',NULL),
('GE-KA', 'GE', 'KA', 'Kakhet’i', 'Region',NULL),
('GE-KK', 'GE', 'KK', 'K’vemo K’art’li', 'Region',NULL),
('GE-MM', 'GE', 'MM', 'Mts’khet’a-Mt’ianet’i', 'Region',NULL),
('GE-RL', 'GE', 'RL', 'Racha-Lech’khumi-K’vemo Svanet’i', 'Region',NULL),
('GE-SZ', 'GE', 'SZ', 'Samegrelo-Zemo Svanet’i', 'Region',NULL),
('GE-SJ', 'GE', 'SJ', 'Samts’khe-Javakhet’i', 'Region',NULL),
('GE-SK', 'GE', 'SK', 'Shida K’art’li', 'Region',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('DE', 'DEU', 'Germany', '', 'Federal Republic of Germany');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('DE-BW', 'DE', 'BW', 'Baden-Württemberg', 'State',NULL),
('DE-BY', 'DE', 'BY', 'Bayern', 'State',NULL),
('DE-HB', 'DE', 'HB', 'Bremen', 'State',NULL),
('DE-HH', 'DE', 'HH', 'Hamburg', 'State',NULL),
('DE-HE', 'DE', 'HE', 'Hessen', 'State',NULL),
('DE-NI', 'DE', 'NI', 'Niedersachsen', 'State',NULL),
('DE-NW', 'DE', 'NW', 'Nordrhein-Westfalen', 'State',NULL),
('DE-RP', 'DE', 'RP', 'Rheinland-Pfalz', 'State',NULL),
('DE-SL', 'DE', 'SL', 'Saarland', 'State',NULL),
('DE-SH', 'DE', 'SH', 'Schleswig-Holstein', 'State',NULL),
('DE-BE', 'DE', 'BE', 'Berlin', 'State',NULL),
('DE-BB', 'DE', 'BB', 'Brandenburg', 'State',NULL),
('DE-MV', 'DE', 'MV', 'Mecklenburg-Vorpommern', 'State',NULL),
('DE-SN', 'DE', 'SN', 'Sachsen', 'State',NULL),
('DE-ST', 'DE', 'ST', 'Sachsen-Anhalt', 'State',NULL),
('DE-TH', 'DE', 'TH', 'Thüringen', 'State',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('GH', 'GHA', 'Ghana', '', 'Republic of Ghana');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('GH-AH', 'GH', 'AH', 'Ashanti', 'Region',NULL),
('GH-BA', 'GH', 'BA', 'Brong-Ahafo', 'Region',NULL),
('GH-CP', 'GH', 'CP', 'Central', 'Region',NULL),
('GH-EP', 'GH', 'EP', 'Eastern', 'Region',NULL),
('GH-AA', 'GH', 'AA', 'Greater Accra', 'Region',NULL),
('GH-NP', 'GH', 'NP', 'Northern', 'Region',NULL),
('GH-UE', 'GH', 'UE', 'Upper East', 'Region',NULL),
('GH-UW', 'GH', 'UW', 'Upper West', 'Region',NULL),
('GH-TV', 'GH', 'TV', 'Volta', 'Region',NULL),
('GH-WP', 'GH', 'WP', 'Western', 'Region',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('GI', 'GIB', 'Gibraltar', '', '');

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('GR', 'GRC', 'Greece', '', 'Hellenic Republic');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('GR-A', 'GR', 'A', 'Anatoliki Makedonia kai Thraki', 'Administrative region',NULL),
('GR-I', 'GR', 'I', 'Attiki', 'Administrative region',NULL),
('GR-G', 'GR', 'G', 'Dytiki Ellada', 'Administrative region',NULL),
('GR-C', 'GR', 'C', 'Dytiki Makedonia', 'Administrative region',NULL),
('GR-F', 'GR', 'F', 'Ionia Nisia', 'Administrative region',NULL),
('GR-D', 'GR', 'D', 'Ipeiros', 'Administrative region',NULL),
('GR-B', 'GR', 'B', 'Kentriki Makedonia', 'Administrative region',NULL),
('GR-M', 'GR', 'M', 'Kriti', 'Administrative region',NULL),
('GR-L', 'GR', 'L', 'Notio Aigaio', 'Administrative region',NULL),
('GR-J', 'GR', 'J', 'Peloponnisos', 'Administrative region',NULL),
('GR-H', 'GR', 'H', 'Sterea Ellada', 'Administrative region',NULL),
('GR-E', 'GR', 'E', 'Thessalia', 'Administrative region',NULL),
('GR-K', 'GR', 'K', 'Voreio Aigaio', 'Administrative region',NULL),
('GR-69', 'GR', '69', 'Agio Oros', 'Self-governed part',NULL),
('GR-13', 'GR', '13', 'Achaïa', 'Department','GR-G'),
('GR-01', 'GR', '01', 'Aitolia kai Akarnania', 'Department','GR-G'),
('GR-11', 'GR', '11', 'Argolida', 'Department','GR-J'),
('GR-12', 'GR', '12', 'Arkadia', 'Department','GR-J'),
('GR-31', 'GR', '31', 'Arta', 'Department','GR-F'),
('GR-A1', 'GR', 'A1', 'Attiki', 'Department','GR-I'),
('GR-64', 'GR', '64', 'Chalkidiki', 'Department','GR-B'),
('GR-94', 'GR', '94', 'Chania', 'Department','GR-M'),
('GR-85', 'GR', '85', 'Chios', 'Department','GR-K'),
('GR-81', 'GR', '81', 'Dodekanisos', 'Department','GR-L'),
('GR-52', 'GR', '52', 'Drama', 'Department','GR-A'),
('GR-71', 'GR', '71', 'Evros', 'Department','GR-A'),
('GR-05', 'GR', '05', 'Evrytania', 'Department','GR-H'),
('GR-04', 'GR', '04', 'Evvoias', 'Department','GR-H'),
('GR-63', 'GR', '63', 'Florina', 'Department','GR-C'),
('GR-07', 'GR', '07', 'Fokida', 'Department','GR-H'),
('GR-06', 'GR', '06', 'Fthiotida', 'Department','GR-H'),
('GR-51', 'GR', '51', 'Grevena', 'Department','GR-C'),
('GR-14', 'GR', '14', 'Ileia', 'Department','GR-G'),
('GR-53', 'GR', '53', 'Imathia', 'Department','GR-B'),
('GR-33', 'GR', '33', 'Ioannina', 'Department','GR-D'),
('GR-91', 'GR', '91', 'Irakleio', 'Department','GR-M'),
('GR-41', 'GR', '41', 'Karditsa', 'Department','GR-E'),
('GR-56', 'GR', '56', 'Kastoria', 'Department','GR-C'),
('GR-55', 'GR', '55', 'Kavala', 'Department','GR-A'),
('GR-23', 'GR', '23', 'Kefallonia', 'Department','GR-F'),
('GR-22', 'GR', '22', 'Kerkyra', 'Department','GR-F'),
('GR-57', 'GR', '57', 'Kilkis', 'Department','GR-B'),
('GR-15', 'GR', '15', 'Korinthia', 'Department','GR-J'),
('GR-58', 'GR', '58', 'Kozani', 'Department','GR-C'),
('GR-82', 'GR', '82', 'Kyklades', 'Department','GR-L'),
('GR-16', 'GR', '16', 'Lakonia', 'Department','GR-J'),
('GR-42', 'GR', '42', 'Larisa', 'Department','GR-E'),
('GR-92', 'GR', '92', 'Lasithi', 'Department','GR-M'),
('GR-24', 'GR', '24', 'Lefkada', 'Department','GR-F'),
('GR-83', 'GR', '83', 'Lesvos', 'Department','GR-K'),
('GR-43', 'GR', '43', 'Magnisia', 'Department','GR-E'),
('GR-17', 'GR', '17', 'Messinia', 'Department','GR-J'),
('GR-59', 'GR', '59', 'Pella', 'Department','GR-B'),
('GR-61', 'GR', '61', 'Pieria', 'Department','GR-B'),
('GR-34', 'GR', '34', 'Preveza', 'Department','GR-D'),
('GR-93', 'GR', '93', 'Rethymno', 'Department','GR-M'),
('GR-73', 'GR', '73', 'Rodopi', 'Department','GR-A'),
('GR-84', 'GR', '84', 'Samos', 'Department','GR-K'),
('GR-62', 'GR', '62', 'Serres', 'Department','GR-B'),
('GR-32', 'GR', '32', 'Thesprotia', 'Department','GR-D'),
('GR-54', 'GR', '54', 'Thessaloniki', 'Department','GR-B'),
('GR-44', 'GR', '44', 'Trikala', 'Department','GR-E'),
('GR-03', 'GR', '03', 'Voiotia', 'Department','GR-H'),
('GR-72', 'GR', '72', 'Xanthi', 'Department','GR-A'),
('GR-21', 'GR', '21', 'Zakynthos', 'Department','GR-F');

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('GL', 'GRL', 'Greenland', '', '');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('GL-KU', 'GL', 'KU', 'Kommune Kujalleq', 'Municipality',NULL),
('GL-SM', 'GL', 'SM', 'Kommuneqarfik Sermersooq', 'Municipality',NULL),
('GL-QA', 'GL', 'QA', 'Qaasuitsup Kommunia', 'Municipality',NULL),
('GL-QE', 'GL', 'QE', 'Qeqqata Kommunia', 'Municipality',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('GD', 'GRD', 'Grenada', '', '');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('GD-01', 'GD', '01', 'Saint Andrew', 'Parish',NULL),
('GD-02', 'GD', '02', 'Saint David', 'Parish',NULL),
('GD-03', 'GD', '03', 'Saint George', 'Parish',NULL),
('GD-04', 'GD', '04', 'Saint John', 'Parish',NULL),
('GD-05', 'GD', '05', 'Saint Mark', 'Parish',NULL),
('GD-06', 'GD', '06', 'Saint Patrick', 'Parish',NULL),
('GD-10', 'GD', '10', 'Southern Grenadine Islands', 'Dependency',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('GP', 'GLP', 'Guadeloupe', '', '');

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('GU', 'GUM', 'Guam', '', '');

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('GT', 'GTM', 'Guatemala', '', 'Republic of Guatemala');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('GT-AV', 'GT', 'AV', 'Alta Verapaz', 'Department',NULL),
('GT-BV', 'GT', 'BV', 'Baja Verapaz', 'Department',NULL),
('GT-CM', 'GT', 'CM', 'Chimaltenango', 'Department',NULL),
('GT-CQ', 'GT', 'CQ', 'Chiquimula', 'Department',NULL),
('GT-PR', 'GT', 'PR', 'El Progreso', 'Department',NULL),
('GT-ES', 'GT', 'ES', 'Escuintla', 'Department',NULL),
('GT-GU', 'GT', 'GU', 'Guatemala', 'Department',NULL),
('GT-HU', 'GT', 'HU', 'Huehuetenango', 'Department',NULL),
('GT-IZ', 'GT', 'IZ', 'Izabal', 'Department',NULL),
('GT-JA', 'GT', 'JA', 'Jalapa', 'Department',NULL),
('GT-JU', 'GT', 'JU', 'Jutiapa', 'Department',NULL),
('GT-PE', 'GT', 'PE', 'Petén', 'Department',NULL),
('GT-QZ', 'GT', 'QZ', 'Quetzaltenango', 'Department',NULL),
('GT-QC', 'GT', 'QC', 'Quiché', 'Department',NULL),
('GT-RE', 'GT', 'RE', 'Retalhuleu', 'Department',NULL),
('GT-SA', 'GT', 'SA', 'Sacatepéquez', 'Department',NULL),
('GT-SM', 'GT', 'SM', 'San Marcos', 'Department',NULL),
('GT-SR', 'GT', 'SR', 'Santa Rosa', 'Department',NULL),
('GT-SO', 'GT', 'SO', 'Sololá', 'Department',NULL),
('GT-SU', 'GT', 'SU', 'Suchitepéquez', 'Department',NULL),
('GT-TO', 'GT', 'TO', 'Totonicapán', 'Department',NULL),
('GT-ZA', 'GT', 'ZA', 'Zacapa', 'Department',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('GG', 'GGY', 'Guernsey', '', '');

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('GN', 'GIN', 'Guinea', '', 'Republic of Guinea');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('GN-B', 'GN', 'B', 'Boké', 'Governorate',NULL),
('GN-F', 'GN', 'F', 'Faranah', 'Governorate',NULL),
('GN-K', 'GN', 'K', 'Kankan', 'Governorate',NULL),
('GN-D', 'GN', 'D', 'Kindia', 'Governorate',NULL),
('GN-L', 'GN', 'L', 'Labé', 'Governorate',NULL),
('GN-M', 'GN', 'M', 'Mamou', 'Governorate',NULL),
('GN-N', 'GN', 'N', 'Nzérékoré', 'Governorate',NULL),
('GN-C', 'GN', 'C', 'Conakry', 'Special zone',NULL),
('GN-BE', 'GN', 'BE', 'Beyla', 'Prefecture','GN-N'),
('GN-BF', 'GN', 'BF', 'Boffa', 'Prefecture','GN-B'),
('GN-BK', 'GN', 'BK', 'Boké', 'Prefecture','GN-B'),
('GN-CO', 'GN', 'CO', 'Coyah', 'Prefecture','GN-D'),
('GN-DB', 'GN', 'DB', 'Dabola', 'Prefecture','GN-F'),
('GN-DL', 'GN', 'DL', 'Dalaba', 'Prefecture','GN-M'),
('GN-DI', 'GN', 'DI', 'Dinguiraye', 'Prefecture','GN-F'),
('GN-DU', 'GN', 'DU', 'Dubréka', 'Prefecture','GN-D'),
('GN-FA', 'GN', 'FA', 'Faranah', 'Prefecture','GN-F'),
('GN-FO', 'GN', 'FO', 'Forécariah', 'Prefecture','GN-D'),
('GN-FR', 'GN', 'FR', 'Fria', 'Prefecture','GN-B'),
('GN-GA', 'GN', 'GA', 'Gaoual', 'Prefecture','GN-B'),
('GN-GU', 'GN', 'GU', 'Guékédou', 'Prefecture','GN-N'),
('GN-KA', 'GN', 'KA', 'Kankan', 'Prefecture','GN-K'),
('GN-KE', 'GN', 'KE', 'Kérouané', 'Prefecture','GN-K'),
('GN-KD', 'GN', 'KD', 'Kindia', 'Prefecture','GN-D'),
('GN-KS', 'GN', 'KS', 'Kissidougou', 'Prefecture','GN-F'),
('GN-KB', 'GN', 'KB', 'Koubia', 'Prefecture','GN-L'),
('GN-KN', 'GN', 'KN', 'Koundara', 'Prefecture','GN-B'),
('GN-KO', 'GN', 'KO', 'Kouroussa', 'Prefecture','GN-K'),
('GN-LA', 'GN', 'LA', 'Labé', 'Prefecture','GN-L'),
('GN-LE', 'GN', 'LE', 'Lélouma', 'Prefecture','GN-L'),
('GN-LO', 'GN', 'LO', 'Lola', 'Prefecture','GN-N'),
('GN-MC', 'GN', 'MC', 'Macenta', 'Prefecture','GN-N'),
('GN-ML', 'GN', 'ML', 'Mali', 'Prefecture','GN-L'),
('GN-MM', 'GN', 'MM', 'Mamou', 'Prefecture','GN-M'),
('GN-MD', 'GN', 'MD', 'Mandiana', 'Prefecture','GN-K'),
('GN-NZ', 'GN', 'NZ', 'Nzérékoré', 'Prefecture','GN-N'),
('GN-PI', 'GN', 'PI', 'Pita', 'Prefecture','GN-M'),
('GN-SI', 'GN', 'SI', 'Siguiri', 'Prefecture','GN-K'),
('GN-TE', 'GN', 'TE', 'Télimélé', 'Prefecture','GN-D'),
('GN-TO', 'GN', 'TO', 'Tougué', 'Prefecture','GN-L'),
('GN-YO', 'GN', 'YO', 'Yomou', 'Prefecture','GN-N');

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('GW', 'GNB', 'Guinea-Bissau', '', 'Republic of Guinea-Bissau');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('GW-BS', 'GW', 'BS', 'Bissau', 'Autonomous sector',NULL),
('GW-L', 'GW', 'L', 'Leste', 'Province',NULL),
('GW-N', 'GW', 'N', 'Norte', 'Province',NULL),
('GW-S', 'GW', 'S', 'Sul', 'Province',NULL),
('GW-BA', 'GW', 'BA', 'Bafatá', 'Region','GW-L'),
('GW-BM', 'GW', 'BM', 'Biombo', 'Region','GW-N'),
('GW-BL', 'GW', 'BL', 'Bolama', 'Region','GW-S'),
('GW-CA', 'GW', 'CA', 'Cacheu', 'Region','GW-N'),
('GW-GA', 'GW', 'GA', 'Gabú', 'Region','GW-L'),
('GW-OI', 'GW', 'OI', 'Oio', 'Region','GW-N'),
('GW-QU', 'GW', 'QU', 'Quinara', 'Region','GW-S'),
('GW-TO', 'GW', 'TO', 'Tombali', 'Region','GW-S');

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('GY', 'GUY', 'Guyana', '', 'Republic of Guyana');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('GY-BA', 'GY', 'BA', 'Barima-Waini', 'Region',NULL),
('GY-CU', 'GY', 'CU', 'Cuyuni-Mazaruni', 'Region',NULL),
('GY-DE', 'GY', 'DE', 'Demerara-Mahaica', 'Region',NULL),
('GY-EB', 'GY', 'EB', 'East Berbice-Corentyne', 'Region',NULL),
('GY-ES', 'GY', 'ES', 'Essequibo Islands-West Demerara', 'Region',NULL),
('GY-MA', 'GY', 'MA', 'Mahaica-Berbice', 'Region',NULL),
('GY-PM', 'GY', 'PM', 'Pomeroon-Supenaam', 'Region',NULL),
('GY-PT', 'GY', 'PT', 'Potaro-Siparuni', 'Region',NULL),
('GY-UD', 'GY', 'UD', 'Upper Demerara-Berbice', 'Region',NULL),
('GY-UT', 'GY', 'UT', 'Upper Takutu-Upper Essequibo', 'Region',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('HT', 'HTI', 'Haiti', '', 'Republic of Haiti');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('HT-AR', 'HT', 'AR', 'Artibonite', 'Department',NULL),
('HT-CE', 'HT', 'CE', 'Centre', 'Department',NULL),
('HT-GA', 'HT', 'GA', 'Grande-Anse', 'Department',NULL),
('HT-ND', 'HT', 'ND', 'Nord', 'Department',NULL),
('HT-NE', 'HT', 'NE', 'Nord-Est', 'Department',NULL),
('HT-NO', 'HT', 'NO', 'Nord-Ouest', 'Department',NULL),
('HT-OU', 'HT', 'OU', 'Ouest', 'Department',NULL),
('HT-SD', 'HT', 'SD', 'Sud', 'Department',NULL),
('HT-SE', 'HT', 'SE', 'Sud-Est', 'Department',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('HM', 'HMD', 'Heard Island and McDonald Islands', '', '');

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('VA', 'VAT', 'Holy See (Vatican City State)', '', '');

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('HN', 'HND', 'Honduras', '', 'Republic of Honduras');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('HN-AT', 'HN', 'AT', 'Atlántida', 'Department',NULL),
('HN-CL', 'HN', 'CL', 'Colón', 'Department',NULL),
('HN-CM', 'HN', 'CM', 'Comayagua', 'Department',NULL),
('HN-CP', 'HN', 'CP', 'Copán', 'Department',NULL),
('HN-CR', 'HN', 'CR', 'Cortés', 'Department',NULL),
('HN-CH', 'HN', 'CH', 'Choluteca', 'Department',NULL),
('HN-EP', 'HN', 'EP', 'El Paraíso', 'Department',NULL),
('HN-FM', 'HN', 'FM', 'Francisco Morazán', 'Department',NULL),
('HN-GD', 'HN', 'GD', 'Gracias a Dios', 'Department',NULL),
('HN-IN', 'HN', 'IN', 'Intibucá', 'Department',NULL),
('HN-IB', 'HN', 'IB', 'Islas de la Bahía', 'Department',NULL),
('HN-LP', 'HN', 'LP', 'La Paz', 'Department',NULL),
('HN-LE', 'HN', 'LE', 'Lempira', 'Department',NULL),
('HN-OC', 'HN', 'OC', 'Ocotepeque', 'Department',NULL),
('HN-OL', 'HN', 'OL', 'Olancho', 'Department',NULL),
('HN-SB', 'HN', 'SB', 'Santa Bárbara', 'Department',NULL),
('HN-VA', 'HN', 'VA', 'Valle', 'Department',NULL),
('HN-YO', 'HN', 'YO', 'Yoro', 'Department',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('HK', 'HKG', 'Hong Kong', '', 'Hong Kong Special Administrative Region of China');

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('HU', 'HUN', 'Hungary', '', 'Hungary');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('HU-BK', 'HU', 'BK', 'Bács-Kiskun', 'County',NULL),
('HU-BA', 'HU', 'BA', 'Baranya', 'County',NULL),
('HU-BE', 'HU', 'BE', 'Békés', 'County',NULL),
('HU-BZ', 'HU', 'BZ', 'Borsod-Abaúj-Zemplén', 'County',NULL),
('HU-CS', 'HU', 'CS', 'Csongrád', 'County',NULL),
('HU-FE', 'HU', 'FE', 'Fejér', 'County',NULL),
('HU-GS', 'HU', 'GS', 'Győr-Moson-Sopron', 'County',NULL),
('HU-HB', 'HU', 'HB', 'Hajdú-Bihar', 'County',NULL),
('HU-HE', 'HU', 'HE', 'Heves', 'County',NULL),
('HU-JN', 'HU', 'JN', 'Jász-Nagykun-Szolnok', 'County',NULL),
('HU-KE', 'HU', 'KE', 'Komárom-Esztergom', 'County',NULL),
('HU-NO', 'HU', 'NO', 'Nógrád', 'County',NULL),
('HU-PE', 'HU', 'PE', 'Pest', 'County',NULL),
('HU-SO', 'HU', 'SO', 'Somogy', 'County',NULL),
('HU-SZ', 'HU', 'SZ', 'Szabolcs-Szatmár-Bereg', 'County',NULL),
('HU-TO', 'HU', 'TO', 'Tolna', 'County',NULL),
('HU-VA', 'HU', 'VA', 'Vas', 'County',NULL),
('HU-VE', 'HU', 'VE', 'Veszprém (county)', 'County',NULL),
('HU-ZA', 'HU', 'ZA', 'Zala', 'County',NULL),
('HU-BC', 'HU', 'BC', 'Békéscsaba', 'City with county rights',NULL),
('HU-DE', 'HU', 'DE', 'Debrecen', 'City with county rights',NULL),
('HU-DU', 'HU', 'DU', 'Dunaújváros', 'City with county rights',NULL),
('HU-EG', 'HU', 'EG', 'Eger', 'City with county rights',NULL),
('HU-ER', 'HU', 'ER', 'Érd', 'City with county rights',NULL),
('HU-GY', 'HU', 'GY', 'Győr', 'City with county rights',NULL),
('HU-HV', 'HU', 'HV', 'Hódmezővásárhely', 'City with county rights',NULL),
('HU-KV', 'HU', 'KV', 'Kaposvár', 'City with county rights',NULL),
('HU-KM', 'HU', 'KM', 'Kecskemét', 'City with county rights',NULL),
('HU-MI', 'HU', 'MI', 'Miskolc', 'City with county rights',NULL),
('HU-NK', 'HU', 'NK', 'Nagykanizsa', 'City with county rights',NULL),
('HU-NY', 'HU', 'NY', 'Nyíregyháza', 'City with county rights',NULL),
('HU-PS', 'HU', 'PS', 'Pécs', 'City with county rights',NULL),
('HU-ST', 'HU', 'ST', 'Salgótarján', 'City with county rights',NULL),
('HU-SN', 'HU', 'SN', 'Sopron', 'City with county rights',NULL),
('HU-SD', 'HU', 'SD', 'Szeged', 'City with county rights',NULL),
('HU-SF', 'HU', 'SF', 'Székesfehérvár', 'City with county rights',NULL),
('HU-SS', 'HU', 'SS', 'Szekszárd', 'City with county rights',NULL),
('HU-SK', 'HU', 'SK', 'Szolnok', 'City with county rights',NULL),
('HU-SH', 'HU', 'SH', 'Szombathely', 'City with county rights',NULL),
('HU-TB', 'HU', 'TB', 'Tatabánya', 'City with county rights',NULL),
('HU-VM', 'HU', 'VM', 'Veszprém', 'City with county rights',NULL),
('HU-ZE', 'HU', 'ZE', 'Zalaegerszeg', 'City with county rights',NULL),
('HU-BU', 'HU', 'BU', 'Budapest', 'Capital city',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('IS', 'ISL', 'Iceland', '', 'Republic of Iceland');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('IS-7', 'IS', '7', 'Austurland', 'Region',NULL),
('IS-1', 'IS', '1', 'Höfuðborgarsvæðið', 'Region',NULL),
('IS-6', 'IS', '6', 'Norðurland eystra', 'Region',NULL),
('IS-5', 'IS', '5', 'Norðurland vestra', 'Region',NULL),
('IS-8', 'IS', '8', 'Suðurland', 'Region',NULL),
('IS-2', 'IS', '2', 'Suðurnes', 'Region',NULL),
('IS-4', 'IS', '4', 'Vestfirðir', 'Region',NULL),
('IS-3', 'IS', '3', 'Vesturland', 'Region',NULL),
('IS-0', 'IS', '0', 'Reykjavík', 'City',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('IN', 'IND', 'India', '', 'Republic of India');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('IN-AP', 'IN', 'AP', 'Andhra Pradesh', 'State',NULL),
('IN-AR', 'IN', 'AR', 'Arunachal Pradesh', 'State',NULL),
('IN-AS', 'IN', 'AS', 'Assam', 'State',NULL),
('IN-BR', 'IN', 'BR', 'Bihar', 'State',NULL),
('IN-CT', 'IN', 'CT', 'Chhattisgarh', 'State',NULL),
('IN-GA', 'IN', 'GA', 'Goa', 'State',NULL),
('IN-GJ', 'IN', 'GJ', 'Gujarat', 'State',NULL),
('IN-HR', 'IN', 'HR', 'Haryana', 'State',NULL),
('IN-HP', 'IN', 'HP', 'Himachal Pradesh', 'State',NULL),
('IN-JK', 'IN', 'JK', 'Jammu and Kashmir', 'State',NULL),
('IN-JH', 'IN', 'JH', 'Jharkhand', 'State',NULL),
('IN-KA', 'IN', 'KA', 'Karnataka', 'State',NULL),
('IN-KL', 'IN', 'KL', 'Kerala', 'State',NULL),
('IN-MP', 'IN', 'MP', 'Madhya Pradesh', 'State',NULL),
('IN-MH', 'IN', 'MH', 'Maharashtra', 'State',NULL),
('IN-MN', 'IN', 'MN', 'Manipur', 'State',NULL),
('IN-ML', 'IN', 'ML', 'Meghalaya', 'State',NULL),
('IN-MZ', 'IN', 'MZ', 'Mizoram', 'State',NULL),
('IN-NL', 'IN', 'NL', 'Nagaland', 'State',NULL),
('IN-OR', 'IN', 'OR', 'Orissa', 'State',NULL),
('IN-PB', 'IN', 'PB', 'Punjab', 'State',NULL),
('IN-RJ', 'IN', 'RJ', 'Rajasthan', 'State',NULL),
('IN-SK', 'IN', 'SK', 'Sikkim', 'State',NULL),
('IN-TN', 'IN', 'TN', 'Tamil Nadu', 'State',NULL),
('IN-TR', 'IN', 'TR', 'Tripura', 'State',NULL),
('IN-UT', 'IN', 'UT', 'Uttarakhand', 'State',NULL),
('IN-UP', 'IN', 'UP', 'Uttar Pradesh', 'State',NULL),
('IN-WB', 'IN', 'WB', 'West Bengal', 'State',NULL),
('IN-AN', 'IN', 'AN', 'Andaman and Nicobar Islands', 'Union territory',NULL),
('IN-CH', 'IN', 'CH', 'Chandigarh', 'Union territory',NULL),
('IN-DN', 'IN', 'DN', 'Dadra and Nagar Haveli', 'Union territory',NULL),
('IN-DD', 'IN', 'DD', 'Damen and Diu', 'Union territory',NULL),
('IN-DL', 'IN', 'DL', 'Delhi', 'Union territory',NULL),
('IN-LD', 'IN', 'LD', 'Lakshadweep', 'Union territory',NULL),
('IN-PY', 'IN', 'PY', 'Puducherry', 'Union territory',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('ID', 'IDN', 'Indonesia', '', 'Republic of Indonesia');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('ID-JW', 'ID', 'JW', 'Jawa', 'Geographical unit',NULL),
('ID-KA', 'ID', 'KA', 'Kalimantan', 'Geographical unit',NULL),
('ID-ML', 'ID', 'ML', 'Maluku', 'Geographical unit',NULL),
('ID-NU', 'ID', 'NU', 'Nusa Tenggara', 'Geographical unit',NULL),
('ID-IJ', 'ID', 'IJ', 'Papua', 'Geographical unit',NULL),
('ID-SL', 'ID', 'SL', 'Sulawesi', 'Geographical unit',NULL),
('ID-SM', 'ID', 'SM', 'Sumatera', 'Geographical unit',NULL),
('ID-AC', 'ID', 'AC', 'Aceh', 'Autonomous Province','ID-SM'),
('ID-BA', 'ID', 'BA', 'Bali', 'Province','ID-NU'),
('ID-BB', 'ID', 'BB', 'Bangka Belitung', 'Province','ID-SM'),
('ID-BT', 'ID', 'BT', 'Banten', 'Province','ID-JW'),
('ID-BE', 'ID', 'BE', 'Bengkulu', 'Province','ID-SM'),
('ID-GO', 'ID', 'GO', 'Gorontalo', 'Province','ID-SL'),
('ID-JA', 'ID', 'JA', 'Jambi', 'Province','ID-SM'),
('ID-JB', 'ID', 'JB', 'Jawa Barat', 'Province','ID-JW'),
('ID-JT', 'ID', 'JT', 'Jawa Tengah', 'Province','ID-JW'),
('ID-JI', 'ID', 'JI', 'Jawa Timur', 'Province','ID-JW'),
('ID-KB', 'ID', 'KB', 'Kalimantan Barat', 'Province','ID-KA'),
('ID-KT', 'ID', 'KT', 'Kalimantan Tengah', 'Province','ID-KA'),
('ID-KS', 'ID', 'KS', 'Kalimantan Selatan', 'Province','ID-KA'),
('ID-KI', 'ID', 'KI', 'Kalimantan Timur', 'Province','ID-KA'),
('ID-KR', 'ID', 'KR', 'Kepulauan Riau', 'Province','ID-SM'),
('ID-LA', 'ID', 'LA', 'Lampung', 'Province','ID-SM'),
('ID-MA', 'ID', 'MA', 'Maluku', 'Province','ID-ML'),
('ID-MU', 'ID', 'MU', 'Maluku Utara', 'Province','ID-ML'),
('ID-NB', 'ID', 'NB', 'Nusa Tenggara Barat', 'Province','ID-NU'),
('ID-NT', 'ID', 'NT', 'Nusa Tenggara Timur', 'Province','ID-NU'),
('ID-PA', 'ID', 'PA', 'Papua', 'Province','ID-IJ'),
('ID-PB', 'ID', 'PB', 'Papua Barat', 'Province','ID-IJ'),
('ID-RI', 'ID', 'RI', 'Riau', 'Province','ID-SM'),
('ID-SR', 'ID', 'SR', 'Sulawesi Barat', 'Province','ID-SL'),
('ID-SN', 'ID', 'SN', 'Sulawesi Selatan', 'Province','ID-SL'),
('ID-ST', 'ID', 'ST', 'Sulawesi Tengah', 'Province','ID-SL'),
('ID-SG', 'ID', 'SG', 'Sulawesi Tenggara', 'Province','ID-SL'),
('ID-SA', 'ID', 'SA', 'Sulawesi Utara', 'Province','ID-SL'),
('ID-SB', 'ID', 'SB', 'Sumatra Barat', 'Province','ID-SM'),
('ID-SS', 'ID', 'SS', 'Sumatra Selatan', 'Province','ID-SM'),
('ID-SU', 'ID', 'SU', 'Sumatera Utara', 'Province','ID-SM'),
('ID-JK', 'ID', 'JK', 'Jakarta Raya', 'Special District','ID-JW'),
('ID-YO', 'ID', 'YO', 'Yogyakarta', 'Special Region','ID-JW');

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('IR', 'IRN', 'Iran, Islamic Republic of', '', 'Islamic Republic of Iran');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('IR-03', 'IR', '03', 'Ardabīl', 'Province',NULL),
('IR-02', 'IR', '02', 'Āzarbāyjān-e Gharbī', 'Province',NULL),
('IR-01', 'IR', '01', 'Āzarbāyjān-e Sharqī', 'Province',NULL),
('IR-06', 'IR', '06', 'Būshehr', 'Province',NULL),
('IR-08', 'IR', '08', 'Chahār Mahāll va Bakhtīārī', 'Province',NULL),
('IR-04', 'IR', '04', 'Eşfahān', 'Province',NULL),
('IR-14', 'IR', '14', 'Fārs', 'Province',NULL),
('IR-19', 'IR', '19', 'Gīlān', 'Province',NULL),
('IR-27', 'IR', '27', 'Golestān', 'Province',NULL),
('IR-24', 'IR', '24', 'Hamadān', 'Province',NULL),
('IR-23', 'IR', '23', 'Hormozgān', 'Province',NULL),
('IR-05', 'IR', '05', 'Īlām', 'Province',NULL),
('IR-15', 'IR', '15', 'Kermān', 'Province',NULL),
('IR-17', 'IR', '17', 'Kermānshāh', 'Province',NULL),
('IR-29', 'IR', '29', 'Khorāsān-e Janūbī', 'Province',NULL),
('IR-30', 'IR', '30', 'Khorāsān-e Razavī', 'Province',NULL),
('IR-31', 'IR', '31', 'Khorāsān-e Shemālī', 'Province',NULL),
('IR-10', 'IR', '10', 'Khūzestān', 'Province',NULL),
('IR-18', 'IR', '18', 'Kohgīlūyeh va Būyer Ahmad', 'Province',NULL),
('IR-16', 'IR', '16', 'Kordestān', 'Province',NULL),
('IR-20', 'IR', '20', 'Lorestān', 'Province',NULL),
('IR-22', 'IR', '22', 'Markazī', 'Province',NULL),
('IR-21', 'IR', '21', 'Māzandarān', 'Province',NULL),
('IR-28', 'IR', '28', 'Qazvīn', 'Province',NULL),
('IR-26', 'IR', '26', 'Qom', 'Province',NULL),
('IR-12', 'IR', '12', 'Semnān', 'Province',NULL),
('IR-13', 'IR', '13', 'Sīstān va Balūchestān', 'Province',NULL),
('IR-07', 'IR', '07', 'Tehrān', 'Province',NULL),
('IR-25', 'IR', '25', 'Yazd', 'Province',NULL),
('IR-11', 'IR', '11', 'Zanjān', 'Province',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('IQ', 'IRQ', 'Iraq', '', 'Republic of Iraq');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('IQ-AN', 'IQ', 'AN', 'Al Anbar', 'Governorate',NULL),
('IQ-BA', 'IQ', 'BA', 'Al Basrah', 'Governorate',NULL),
('IQ-MU', 'IQ', 'MU', 'Al Muthanna', 'Governorate',NULL),
('IQ-QA', 'IQ', 'QA', 'Al Qadisiyah', 'Governorate',NULL),
('IQ-NA', 'IQ', 'NA', 'An Najef', 'Governorate',NULL),
('IQ-AR', 'IQ', 'AR', 'Arbil', 'Governorate',NULL),
('IQ-SW', 'IQ', 'SW', 'As Sulaymaniyah', 'Governorate',NULL),
('IQ-TS', 'IQ', 'TS', 'At Ta''mim', 'Governorate',NULL),
('IQ-BB', 'IQ', 'BB', 'Babil', 'Governorate',NULL),
('IQ-BG', 'IQ', 'BG', 'Baghdad', 'Governorate',NULL),
('IQ-DA', 'IQ', 'DA', 'Dahuk', 'Governorate',NULL),
('IQ-DQ', 'IQ', 'DQ', 'Dhi Qar', 'Governorate',NULL),
('IQ-DI', 'IQ', 'DI', 'Diyala', 'Governorate',NULL),
('IQ-KA', 'IQ', 'KA', 'Karbala''', 'Governorate',NULL),
('IQ-MA', 'IQ', 'MA', 'Maysan', 'Governorate',NULL),
('IQ-NI', 'IQ', 'NI', 'Ninawa', 'Governorate',NULL),
('IQ-SD', 'IQ', 'SD', 'Salah ad Din', 'Governorate',NULL),
('IQ-WA', 'IQ', 'WA', 'Wasit', 'Governorate',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('IE', 'IRL', 'Ireland', '', '');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('IE-C', 'IE', 'C', 'Connacht', 'Province',NULL),
('IE-L', 'IE', 'L', 'Leinster', 'Province',NULL),
('IE-M', 'IE', 'M', 'Munster', 'Province',NULL),
('IE-U', 'IE', 'U', 'Ulster', 'Province',NULL),
('IE-CW', 'IE', 'CW', 'Carlow', 'County','IE-L'),
('IE-CN', 'IE', 'CN', 'Cavan', 'County','IE-U'),
('IE-CE', 'IE', 'CE', 'Clare', 'County','IE-M'),
('IE-CO', 'IE', 'CO', 'Cork', 'County','IE-M'),
('IE-DL', 'IE', 'DL', 'Donegal', 'County','IE-U'),
('IE-D', 'IE', 'D', 'Dublin', 'County','IE-L'),
('IE-G', 'IE', 'G', 'Galway', 'County','IE-C'),
('IE-KY', 'IE', 'KY', 'Kerry', 'County','IE-M'),
('IE-KE', 'IE', 'KE', 'Kildare', 'County','IE-L'),
('IE-KK', 'IE', 'KK', 'Kilkenny', 'County','IE-L'),
('IE-LS', 'IE', 'LS', 'Laois', 'County','IE-L'),
('IE-LM', 'IE', 'LM', 'Leitrim', 'County','IE-C'),
('IE-LK', 'IE', 'LK', 'Limerick', 'County','IE-M'),
('IE-LD', 'IE', 'LD', 'Longford', 'County','IE-L'),
('IE-LH', 'IE', 'LH', 'Louth', 'County','IE-L'),
('IE-MO', 'IE', 'MO', 'Mayo', 'County','IE-C'),
('IE-MH', 'IE', 'MH', 'Meath', 'County','IE-L'),
('IE-MN', 'IE', 'MN', 'Monaghan', 'County','IE-U'),
('IE-OY', 'IE', 'OY', 'Offaly', 'County','IE-L'),
('IE-RN', 'IE', 'RN', 'Roscommon', 'County','IE-C'),
('IE-SO', 'IE', 'SO', 'Sligo', 'County','IE-C'),
('IE-TA', 'IE', 'TA', 'Tipperary', 'County','IE-M'),
('IE-WD', 'IE', 'WD', 'Waterford', 'County','IE-M'),
('IE-WH', 'IE', 'WH', 'Westmeath', 'County','IE-L'),
('IE-WX', 'IE', 'WX', 'Wexford', 'County','IE-L'),
('IE-WW', 'IE', 'WW', 'Wicklow', 'County','IE-L');

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('IM', 'IMN', 'Isle of Man', '', '');

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('IL', 'ISR', 'Israel', '', 'State of Israel');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('IL-D', 'IL', 'D', 'HaDarom', 'District',NULL),
('IL-M', 'IL', 'M', 'HaMerkaz', 'District',NULL),
('IL-Z', 'IL', 'Z', 'HaZafon', 'District',NULL),
('IL-HA', 'IL', 'HA', 'Hefa', 'District',NULL),
('IL-TA', 'IL', 'TA', 'Tel-Aviv', 'District',NULL),
('IL-JM', 'IL', 'JM', 'Yerushalayim Al Quds', 'District',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('IT', 'ITA', 'Italy', '', 'Italian Republic');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('IT-65', 'IT', '65', 'Abruzzo', 'Region',NULL),
('IT-77', 'IT', '77', 'Basilicata', 'Region',NULL),
('IT-78', 'IT', '78', 'Calabria', 'Region',NULL),
('IT-72', 'IT', '72', 'Campania', 'Region',NULL),
('IT-45', 'IT', '45', 'Emilia-Romagna', 'Region',NULL),
('IT-36', 'IT', '36', 'Friuli-Venezia Giulia', 'Region',NULL),
('IT-62', 'IT', '62', 'Lazio', 'Region',NULL),
('IT-42', 'IT', '42', 'Liguria', 'Region',NULL),
('IT-25', 'IT', '25', 'Lombardia', 'Region',NULL),
('IT-57', 'IT', '57', 'Marche', 'Region',NULL),
('IT-67', 'IT', '67', 'Molise', 'Region',NULL),
('IT-21', 'IT', '21', 'Piemonte', 'Region',NULL),
('IT-75', 'IT', '75', 'Puglia', 'Region',NULL),
('IT-88', 'IT', '88', 'Sardegna', 'Region',NULL),
('IT-82', 'IT', '82', 'Sicilia', 'Region',NULL),
('IT-52', 'IT', '52', 'Toscana', 'Region',NULL),
('IT-32', 'IT', '32', 'Trentino-Alto Adige', 'Region',NULL),
('IT-55', 'IT', '55', 'Umbria', 'Region',NULL),
('IT-23', 'IT', '23', 'Valle d''Aosta', 'Region',NULL),
('IT-34', 'IT', '34', 'Veneto', 'Region',NULL),
('IT-AG', 'IT', 'AG', 'Agrigento', 'Province','IT-82'),
('IT-AL', 'IT', 'AL', 'Alessandria', 'Province','IT-21'),
('IT-AN', 'IT', 'AN', 'Ancona', 'Province','IT-57'),
('IT-AO', 'IT', 'AO', 'Aosta', 'Province','IT-23'),
('IT-AR', 'IT', 'AR', 'Arezzo', 'Province','IT-52'),
('IT-AP', 'IT', 'AP', 'Ascoli Piceno', 'Province','IT-57'),
('IT-AT', 'IT', 'AT', 'Asti', 'Province','IT-21'),
('IT-AV', 'IT', 'AV', 'Avellino', 'Province','IT-72'),
('IT-BA', 'IT', 'BA', 'Bari', 'Province','IT-75'),
('IT-BT', 'IT', 'BT', 'Barletta-Andria-Trani', 'Province','IT-75'),
('IT-BL', 'IT', 'BL', 'Belluno', 'Province','IT-34'),
('IT-BN', 'IT', 'BN', 'Benevento', 'Province','IT-72'),
('IT-BG', 'IT', 'BG', 'Bergamo', 'Province','IT-25'),
('IT-BI', 'IT', 'BI', 'Biella', 'Province','IT-21'),
('IT-BO', 'IT', 'BO', 'Bologna', 'Province','IT-45'),
('IT-BZ', 'IT', 'BZ', 'Bolzano', 'Province','IT-32'),
('IT-BS', 'IT', 'BS', 'Brescia', 'Province','IT-25'),
('IT-BR', 'IT', 'BR', 'Brindisi', 'Province','IT-75'),
('IT-CA', 'IT', 'CA', 'Cagliari', 'Province','IT-88'),
('IT-CL', 'IT', 'CL', 'Caltanissetta', 'Province','IT-82'),
('IT-CB', 'IT', 'CB', 'Campobasso', 'Province','IT-67'),
('IT-CI', 'IT', 'CI', 'Carbonia-Iglesias', 'Province','IT-88'),
('IT-CE', 'IT', 'CE', 'Caserta', 'Province','IT-72'),
('IT-CT', 'IT', 'CT', 'Catania', 'Province','IT-82'),
('IT-CZ', 'IT', 'CZ', 'Catanzaro', 'Province','IT-78'),
('IT-CH', 'IT', 'CH', 'Chieti', 'Province','IT-65'),
('IT-CO', 'IT', 'CO', 'Como', 'Province','IT-25'),
('IT-CS', 'IT', 'CS', 'Cosenza', 'Province','IT-78'),
('IT-CR', 'IT', 'CR', 'Cremona', 'Province','IT-25'),
('IT-KR', 'IT', 'KR', 'Crotone', 'Province','IT-78'),
('IT-CN', 'IT', 'CN', 'Cuneo', 'Province','IT-21'),
('IT-EN', 'IT', 'EN', 'Enna', 'Province','IT-82'),
('IT-FM', 'IT', 'FM', 'Fermo', 'Province','IT-57'),
('IT-FE', 'IT', 'FE', 'Ferrara', 'Province','IT-45'),
('IT-FI', 'IT', 'FI', 'Firenze', 'Province','IT-52'),
('IT-FG', 'IT', 'FG', 'Foggia', 'Province','IT-75'),
('IT-FC', 'IT', 'FC', 'Forlì-Cesena', 'Province','IT-45'),
('IT-FR', 'IT', 'FR', 'Frosinone', 'Province','IT-62'),
('IT-GE', 'IT', 'GE', 'Genova', 'Province','IT-42'),
('IT-GO', 'IT', 'GO', 'Gorizia', 'Province','IT-36'),
('IT-GR', 'IT', 'GR', 'Grosseto', 'Province','IT-52'),
('IT-IM', 'IT', 'IM', 'Imperia', 'Province','IT-42'),
('IT-IS', 'IT', 'IS', 'Isernia', 'Province','IT-67'),
('IT-SP', 'IT', 'SP', 'La Spezia', 'Province','IT-42'),
('IT-AQ', 'IT', 'AQ', 'L''Aquila', 'Province','IT-65'),
('IT-LT', 'IT', 'LT', 'Latina', 'Province','IT-62'),
('IT-LE', 'IT', 'LE', 'Lecce', 'Province','IT-75'),
('IT-LC', 'IT', 'LC', 'Lecco', 'Province','IT-25'),
('IT-LI', 'IT', 'LI', 'Livorno', 'Province','IT-52'),
('IT-LO', 'IT', 'LO', 'Lodi', 'Province','IT-25'),
('IT-LU', 'IT', 'LU', 'Lucca', 'Province','IT-52'),
('IT-MC', 'IT', 'MC', 'Macerata', 'Province','IT-57'),
('IT-MN', 'IT', 'MN', 'Mantova', 'Province','IT-25'),
('IT-MS', 'IT', 'MS', 'Massa-Carrara', 'Province','IT-52'),
('IT-MT', 'IT', 'MT', 'Matera', 'Province','IT-77'),
('IT-VS', 'IT', 'VS', 'Medio Campidano', 'Province','IT-88'),
('IT-ME', 'IT', 'ME', 'Messina', 'Province','IT-82'),
('IT-MI', 'IT', 'MI', 'Milano', 'Province','IT-25'),
('IT-MO', 'IT', 'MO', 'Modena', 'Province','IT-45'),
('IT-MB', 'IT', 'MB', 'Monza e Brianza', 'Province','IT-25'),
('IT-NA', 'IT', 'NA', 'Napoli', 'Province','IT-72'),
('IT-NO', 'IT', 'NO', 'Novara', 'Province','IT-21'),
('IT-NU', 'IT', 'NU', 'Nuoro', 'Province','IT-88'),
('IT-OG', 'IT', 'OG', 'Ogliastra', 'Province','IT-88'),
('IT-OT', 'IT', 'OT', 'Olbia-Tempio', 'Province','IT-88'),
('IT-OR', 'IT', 'OR', 'Oristano', 'Province','IT-88'),
('IT-PD', 'IT', 'PD', 'Padova', 'Province','IT-34'),
('IT-PA', 'IT', 'PA', 'Palermo', 'Province','IT-82'),
('IT-PR', 'IT', 'PR', 'Parma', 'Province','IT-45'),
('IT-PV', 'IT', 'PV', 'Pavia', 'Province','IT-25'),
('IT-PG', 'IT', 'PG', 'Perugia', 'Province','IT-55'),
('IT-PU', 'IT', 'PU', 'Pesaro e Urbino', 'Province','IT-57'),
('IT-PE', 'IT', 'PE', 'Pescara', 'Province','IT-65'),
('IT-PC', 'IT', 'PC', 'Piacenza', 'Province','IT-45'),
('IT-PI', 'IT', 'PI', 'Pisa', 'Province','IT-52'),
('IT-PT', 'IT', 'PT', 'Pistoia', 'Province','IT-52'),
('IT-PN', 'IT', 'PN', 'Pordenone', 'Province','IT-36'),
('IT-PZ', 'IT', 'PZ', 'Potenza', 'Province','IT-77'),
('IT-PO', 'IT', 'PO', 'Prato', 'Province','IT-52'),
('IT-RG', 'IT', 'RG', 'Ragusa', 'Province','IT-82'),
('IT-RA', 'IT', 'RA', 'Ravenna', 'Province','IT-45'),
('IT-RC', 'IT', 'RC', 'Reggio Calabria', 'Province','IT-78'),
('IT-RE', 'IT', 'RE', 'Reggio Emilia', 'Province','IT-45'),
('IT-RI', 'IT', 'RI', 'Rieti', 'Province','IT-62'),
('IT-RN', 'IT', 'RN', 'Rimini', 'Province','IT-45'),
('IT-RM', 'IT', 'RM', 'Roma', 'Province','IT-62'),
('IT-RO', 'IT', 'RO', 'Rovigo', 'Province','IT-34'),
('IT-SA', 'IT', 'SA', 'Salerno', 'Province','IT-72'),
('IT-SS', 'IT', 'SS', 'Sassari', 'Province','IT-88'),
('IT-SV', 'IT', 'SV', 'Savona', 'Province','IT-42'),
('IT-SI', 'IT', 'SI', 'Siena', 'Province','IT-52'),
('IT-SR', 'IT', 'SR', 'Siracusa', 'Province','IT-82'),
('IT-SO', 'IT', 'SO', 'Sondrio', 'Province','IT-25'),
('IT-TA', 'IT', 'TA', 'Taranto', 'Province','IT-75'),
('IT-TE', 'IT', 'TE', 'Teramo', 'Province','IT-65'),
('IT-TR', 'IT', 'TR', 'Terni', 'Province','IT-55'),
('IT-TO', 'IT', 'TO', 'Torino', 'Province','IT-21'),
('IT-TP', 'IT', 'TP', 'Trapani', 'Province','IT-82'),
('IT-TN', 'IT', 'TN', 'Trento', 'Province','IT-32'),
('IT-TV', 'IT', 'TV', 'Treviso', 'Province','IT-34'),
('IT-TS', 'IT', 'TS', 'Trieste', 'Province','IT-36'),
('IT-UD', 'IT', 'UD', 'Udine', 'Province','IT-36'),
('IT-VA', 'IT', 'VA', 'Varese', 'Province','IT-25'),
('IT-VE', 'IT', 'VE', 'Venezia', 'Province','IT-34'),
('IT-VB', 'IT', 'VB', 'Verbano-Cusio-Ossola', 'Province','IT-21'),
('IT-VC', 'IT', 'VC', 'Vercelli', 'Province','IT-21'),
('IT-VR', 'IT', 'VR', 'Verona', 'Province','IT-34'),
('IT-VV', 'IT', 'VV', 'Vibo Valentia', 'Province','IT-78'),
('IT-VI', 'IT', 'VI', 'Vicenza', 'Province','IT-34'),
('IT-VT', 'IT', 'VT', 'Viterbo', 'Province','IT-62');

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('JM', 'JAM', 'Jamaica', '', '');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('JM-13', 'JM', '13', 'Clarendon', 'Parish',NULL),
('JM-09', 'JM', '09', 'Hanover', 'Parish',NULL),
('JM-01', 'JM', '01', 'Kingston', 'Parish',NULL),
('JM-12', 'JM', '12', 'Manchester', 'Parish',NULL),
('JM-04', 'JM', '04', 'Portland', 'Parish',NULL),
('JM-02', 'JM', '02', 'Saint Andrew', 'Parish',NULL),
('JM-06', 'JM', '06', 'Saint Ann', 'Parish',NULL),
('JM-14', 'JM', '14', 'Saint Catherine', 'Parish',NULL),
('JM-11', 'JM', '11', 'Saint Elizabeth', 'Parish',NULL),
('JM-08', 'JM', '08', 'Saint James', 'Parish',NULL),
('JM-05', 'JM', '05', 'Saint Mary', 'Parish',NULL),
('JM-03', 'JM', '03', 'Saint Thomas', 'Parish',NULL),
('JM-07', 'JM', '07', 'Trelawny', 'Parish',NULL),
('JM-10', 'JM', '10', 'Westmoreland', 'Parish',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('JP', 'JPN', 'Japan', '', '');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('JP-23', 'JP', '23', 'Aichi', 'Prefecture',NULL),
('JP-05', 'JP', '05', 'Akita', 'Prefecture',NULL),
('JP-02', 'JP', '02', 'Aomori', 'Prefecture',NULL),
('JP-12', 'JP', '12', 'Chiba', 'Prefecture',NULL),
('JP-38', 'JP', '38', 'Ehime', 'Prefecture',NULL),
('JP-18', 'JP', '18', 'Fukui', 'Prefecture',NULL),
('JP-40', 'JP', '40', 'Fukuoka', 'Prefecture',NULL),
('JP-07', 'JP', '07', 'Fukushima', 'Prefecture',NULL),
('JP-21', 'JP', '21', 'Gifu', 'Prefecture',NULL),
('JP-10', 'JP', '10', 'Gunma', 'Prefecture',NULL),
('JP-34', 'JP', '34', 'Hiroshima', 'Prefecture',NULL),
('JP-01', 'JP', '01', 'Hokkaido', 'Prefecture',NULL),
('JP-28', 'JP', '28', 'Hyogo', 'Prefecture',NULL),
('JP-08', 'JP', '08', 'Ibaraki', 'Prefecture',NULL),
('JP-17', 'JP', '17', 'Ishikawa', 'Prefecture',NULL),
('JP-03', 'JP', '03', 'Iwate', 'Prefecture',NULL),
('JP-37', 'JP', '37', 'Kagawa', 'Prefecture',NULL),
('JP-46', 'JP', '46', 'Kagoshima', 'Prefecture',NULL),
('JP-14', 'JP', '14', 'Kanagawa', 'Prefecture',NULL),
('JP-39', 'JP', '39', 'Kochi', 'Prefecture',NULL),
('JP-43', 'JP', '43', 'Kumamoto', 'Prefecture',NULL),
('JP-26', 'JP', '26', 'Kyoto', 'Prefecture',NULL),
('JP-24', 'JP', '24', 'Mie', 'Prefecture',NULL),
('JP-04', 'JP', '04', 'Miyagi', 'Prefecture',NULL),
('JP-45', 'JP', '45', 'Miyazaki', 'Prefecture',NULL),
('JP-20', 'JP', '20', 'Nagano', 'Prefecture',NULL),
('JP-42', 'JP', '42', 'Nagasaki', 'Prefecture',NULL),
('JP-29', 'JP', '29', 'Nara', 'Prefecture',NULL),
('JP-15', 'JP', '15', 'Niigata', 'Prefecture',NULL),
('JP-44', 'JP', '44', 'Oita', 'Prefecture',NULL),
('JP-33', 'JP', '33', 'Okayama', 'Prefecture',NULL),
('JP-47', 'JP', '47', 'Okinawa', 'Prefecture',NULL),
('JP-27', 'JP', '27', 'Osaka', 'Prefecture',NULL),
('JP-41', 'JP', '41', 'Saga', 'Prefecture',NULL),
('JP-11', 'JP', '11', 'Saitama', 'Prefecture',NULL),
('JP-25', 'JP', '25', 'Shiga', 'Prefecture',NULL),
('JP-32', 'JP', '32', 'Shimane', 'Prefecture',NULL),
('JP-22', 'JP', '22', 'Shizuoka', 'Prefecture',NULL),
('JP-09', 'JP', '09', 'Tochigi', 'Prefecture',NULL),
('JP-36', 'JP', '36', 'Tokushima', 'Prefecture',NULL),
('JP-13', 'JP', '13', 'Tokyo', 'Prefecture',NULL),
('JP-31', 'JP', '31', 'Tottori', 'Prefecture',NULL),
('JP-16', 'JP', '16', 'Toyama', 'Prefecture',NULL),
('JP-30', 'JP', '30', 'Wakayama', 'Prefecture',NULL),
('JP-06', 'JP', '06', 'Yamagata', 'Prefecture',NULL),
('JP-35', 'JP', '35', 'Yamaguchi', 'Prefecture',NULL),
('JP-19', 'JP', '19', 'Yamanashi', 'Prefecture',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('JE', 'JEY', 'Jersey', '', '');

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('JO', 'JOR', 'Jordan', '', 'Hashemite Kingdom of Jordan');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('JO-AJ', 'JO', 'AJ', '‘Ajlūn', 'Governorate',NULL),
('JO-AQ', 'JO', 'AQ', 'Al ‘Aqabah', 'Governorate',NULL),
('JO-BA', 'JO', 'BA', 'Al Balqā''', 'Governorate',NULL),
('JO-KA', 'JO', 'KA', 'Al Karak', 'Governorate',NULL),
('JO-MA', 'JO', 'MA', 'Al Mafraq', 'Governorate',NULL),
('JO-AM', 'JO', 'AM', '‘Ammān (Al ‘Aşimah)', 'Governorate',NULL),
('JO-AT', 'JO', 'AT', 'Aţ Ţafīlah', 'Governorate',NULL),
('JO-AZ', 'JO', 'AZ', 'Az Zarqā''', 'Governorate',NULL),
('JO-IR', 'JO', 'IR', 'Irbid', 'Governorate',NULL),
('JO-JA', 'JO', 'JA', 'Jarash', 'Governorate',NULL),
('JO-MN', 'JO', 'MN', 'Ma‘ān', 'Governorate',NULL),
('JO-MD', 'JO', 'MD', 'Mādabā', 'Governorate',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('KZ', 'KAZ', 'Kazakhstan', '', 'Republic of Kazakhstan');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('KZ-ALA', 'KZ', 'ALA', 'Almaty', 'City',NULL),
('KZ-AST', 'KZ', 'AST', 'Astana', 'City',NULL),
('KZ-ALM', 'KZ', 'ALM', 'Almaty oblysy', 'Region',NULL),
('KZ-AKM', 'KZ', 'AKM', 'Aqmola oblysy', 'Region',NULL),
('KZ-AKT', 'KZ', 'AKT', 'Aqtöbe oblysy', 'Region',NULL),
('KZ-ATY', 'KZ', 'ATY', 'Atyraū oblysy', 'Region',NULL),
('KZ-ZAP', 'KZ', 'ZAP', 'Batys Quzaqstan oblysy', 'Region',NULL),
('KZ-MAN', 'KZ', 'MAN', 'Mangghystaū oblysy', 'Region',NULL),
('KZ-YUZ', 'KZ', 'YUZ', 'Ongtüstik Qazaqstan oblysy', 'Region',NULL),
('KZ-PAV', 'KZ', 'PAV', 'Pavlodar oblysy', 'Region',NULL),
('KZ-KAR', 'KZ', 'KAR', 'Qaraghandy oblysy', 'Region',NULL),
('KZ-KUS', 'KZ', 'KUS', 'Qostanay oblysy', 'Region',NULL),
('KZ-KZY', 'KZ', 'KZY', 'Qyzylorda oblysy', 'Region',NULL),
('KZ-VOS', 'KZ', 'VOS', 'Shyghys Qazaqstan oblysy', 'Region',NULL),
('KZ-SEV', 'KZ', 'SEV', 'Soltüstik Quzaqstan oblysy', 'Region',NULL),
('KZ-ZHA', 'KZ', 'ZHA', 'Zhambyl oblysy', 'Region',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('KE', 'KEN', 'Kenya', '', 'Republic of Kenya');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('KE-110', 'KE', '110', 'Nairobi Municipality', 'Province',NULL),
('KE-200', 'KE', '200', 'Central', 'Province',NULL),
('KE-300', 'KE', '300', 'Coast', 'Province',NULL),
('KE-400', 'KE', '400', 'Eastern', 'Province',NULL),
('KE-500', 'KE', '500', 'North-Eastern Kaskazini Mashariki', 'Province',NULL),
('KE-700', 'KE', '700', 'Rift Valley', 'Province',NULL),
('KE-800', 'KE', '800', 'Western Magharibi', 'Province',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('KI', 'KIR', 'Kiribati', '', 'Republic of Kiribati');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('KI-G', 'KI', 'G', 'Gilbert Islands', 'Island group',NULL),
('KI-L', 'KI', 'L', 'Line Islands', 'Island group',NULL),
('KI-P', 'KI', 'P', 'Phoenix Islands', 'Island group',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('KP', 'PRK', 'Korea, Democratic People''s Republic of', '', 'Democratic People''s Republic of Korea');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('KP-01', 'KP', '01', 'P’yŏngyang', 'Capital city',NULL),
('KP-13', 'KP', '13', 'Nasŏn (Najin-Sŏnbong)', 'Special city',NULL),
('KP-02', 'KP', '02', 'P’yŏngan-namdo', 'Province',NULL),
('KP-03', 'KP', '03', 'P’yŏngan-bukto', 'Province',NULL),
('KP-04', 'KP', '04', 'Chagang-do', 'Province',NULL),
('KP-05', 'KP', '05', 'Hwanghae-namdo', 'Province',NULL),
('KP-06', 'KP', '06', 'Hwanghae-bukto', 'Province',NULL),
('KP-07', 'KP', '07', 'Kangwŏn-do', 'Province',NULL),
('KP-08', 'KP', '08', 'Hamgyŏng-namdo', 'Province',NULL),
('KP-09', 'KP', '09', 'Hamgyŏng-bukto', 'Province',NULL),
('KP-10', 'KP', '10', 'Yanggang-do', 'Province',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('KR', 'KOR', 'Korea, Republic of', '', '');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('KR-11', 'KR', '11', 'Seoul Teugbyeolsi', 'Capital Metropolitan City',NULL),
('KR-26', 'KR', '26', 'Busan Gwang''yeogsi', 'Metropolitan cities',NULL),
('KR-27', 'KR', '27', 'Daegu Gwang''yeogsi', 'Metropolitan cities',NULL),
('KR-30', 'KR', '30', 'Daejeon Gwang''yeogsi', 'Metropolitan cities',NULL),
('KR-29', 'KR', '29', 'Gwangju Gwang''yeogsi', 'Metropolitan cities',NULL),
('KR-28', 'KR', '28', 'Incheon Gwang''yeogsi', 'Metropolitan cities',NULL),
('KR-31', 'KR', '31', 'Ulsan Gwang''yeogsi', 'Metropolitan cities',NULL),
('KR-43', 'KR', '43', 'Chungcheongbukdo', 'Province',NULL),
('KR-44', 'KR', '44', 'Chungcheongnamdo', 'Province',NULL),
('KR-42', 'KR', '42', 'Gang''weondo', 'Province',NULL),
('KR-41', 'KR', '41', 'Gyeonggido', 'Province',NULL),
('KR-47', 'KR', '47', 'Gyeongsangbukdo', 'Province',NULL),
('KR-48', 'KR', '48', 'Gyeongsangnamdo', 'Province',NULL),
('KR-49', 'KR', '49', 'Jejudo', 'Province',NULL),
('KR-45', 'KR', '45', 'Jeonrabukdo', 'Province',NULL),
('KR-46', 'KR', '46', 'Jeonranamdo', 'Province',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('KW', 'KWT', 'Kuwait', '', 'State of Kuwait');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('KW-AH', 'KW', 'AH', 'Al Ahmadi', 'Governorate',NULL),
('KW-FA', 'KW', 'FA', 'Al Farwānīyah', 'Governorate',NULL),
('KW-JA', 'KW', 'JA', 'Al Jahrrā’', 'Governorate',NULL),
('KW-KU', 'KW', 'KU', 'Al Kuwayt (Al ‘Āşimah)', 'Governorate',NULL),
('KW-HA', 'KW', 'HA', 'Hawallī', 'Governorate',NULL),
('KW-MU', 'KW', 'MU', 'Mubārak al Kabīr', 'Governorate',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('KG', 'KGZ', 'Kyrgyzstan', '', 'Kyrgyz Republic');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('KG-GB', 'KG', 'GB', 'Bishkek', 'City',NULL),
('KG-B', 'KG', 'B', 'Batken', 'Region',NULL),
('KG-C', 'KG', 'C', 'Chü', 'Region',NULL),
('KG-J', 'KG', 'J', 'Jalal-Abad', 'Region',NULL),
('KG-N', 'KG', 'N', 'Naryn', 'Region',NULL),
('KG-O', 'KG', 'O', 'Osh', 'Region',NULL),
('KG-T', 'KG', 'T', 'Talas', 'Region',NULL),
('KG-Y', 'KG', 'Y', 'Ysyk-Köl', 'Region',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('LA', 'LAO', 'Lao People''s Democratic Republic', '', '');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('LA-VT', 'LA', 'VT', 'Vientiane', 'Prefecture',NULL),
('LA-AT', 'LA', 'AT', 'Attapu', 'Province',NULL),
('LA-BK', 'LA', 'BK', 'Bokèo', 'Province',NULL),
('LA-BL', 'LA', 'BL', 'Bolikhamxai', 'Province',NULL),
('LA-CH', 'LA', 'CH', 'Champasak', 'Province',NULL),
('LA-HO', 'LA', 'HO', 'Houaphan', 'Province',NULL),
('LA-KH', 'LA', 'KH', 'Khammouan', 'Province',NULL),
('LA-LM', 'LA', 'LM', 'Louang Namtha', 'Province',NULL),
('LA-LP', 'LA', 'LP', 'Louangphabang', 'Province',NULL),
('LA-OU', 'LA', 'OU', 'Oudômxai', 'Province',NULL),
('LA-PH', 'LA', 'PH', 'Phôngsali', 'Province',NULL),
('LA-SL', 'LA', 'SL', 'Salavan', 'Province',NULL),
('LA-SV', 'LA', 'SV', 'Savannakhét', 'Province',NULL),
('LA-VI', 'LA', 'VI', 'Vientiane', 'Province',NULL),
('LA-XA', 'LA', 'XA', 'Xaignabouli', 'Province',NULL),
('LA-XE', 'LA', 'XE', 'Xékong', 'Province',NULL),
('LA-XI', 'LA', 'XI', 'Xiangkhoang', 'Province',NULL),
('LA-XN', 'LA', 'XN', 'Xiasômboun', 'Special zone',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('LV', 'LVA', 'Latvia', '', 'Republic of Latvia');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('LV-001', 'LV', '001', 'Aglonas novads', 'Municipality',NULL),
('LV-002', 'LV', '002', 'Aizkraukles novads', 'Municipality',NULL),
('LV-003', 'LV', '003', 'Aizputes novads', 'Municipality',NULL),
('LV-004', 'LV', '004', 'Aknīstes novads', 'Municipality',NULL),
('LV-005', 'LV', '005', 'Alojas novads', 'Municipality',NULL),
('LV-006', 'LV', '006', 'Alsungas novads', 'Municipality',NULL),
('LV-007', 'LV', '007', 'Alūksnes novads', 'Municipality',NULL),
('LV-008', 'LV', '008', 'Amatas novads', 'Municipality',NULL),
('LV-009', 'LV', '009', 'Apes novads', 'Municipality',NULL),
('LV-010', 'LV', '010', 'Auces novads', 'Municipality',NULL),
('LV-011', 'LV', '011', 'Ādažu novads', 'Municipality',NULL),
('LV-012', 'LV', '012', 'Babītes novads', 'Municipality',NULL),
('LV-013', 'LV', '013', 'Baldones novads', 'Municipality',NULL),
('LV-014', 'LV', '014', 'Baltinavas novads', 'Municipality',NULL),
('LV-015', 'LV', '015', 'Balvu novads', 'Municipality',NULL),
('LV-016', 'LV', '016', 'Bauskas novads', 'Municipality',NULL),
('LV-017', 'LV', '017', 'Beverīnas novads', 'Municipality',NULL),
('LV-018', 'LV', '018', 'Brocēnu novads', 'Municipality',NULL),
('LV-019', 'LV', '019', 'Burtnieku novads', 'Municipality',NULL),
('LV-020', 'LV', '020', 'Carnikavas novads', 'Municipality',NULL),
('LV-021', 'LV', '021', 'Cesvaines novads', 'Municipality',NULL),
('LV-022', 'LV', '022', 'Cēsu novads', 'Municipality',NULL),
('LV-023', 'LV', '023', 'Ciblas novads', 'Municipality',NULL),
('LV-024', 'LV', '024', 'Dagdas novads', 'Municipality',NULL),
('LV-025', 'LV', '025', 'Daugavpils novads', 'Municipality',NULL),
('LV-026', 'LV', '026', 'Dobeles novads', 'Municipality',NULL),
('LV-027', 'LV', '027', 'Dundagas novads', 'Municipality',NULL),
('LV-028', 'LV', '028', 'Durbes novads', 'Municipality',NULL),
('LV-029', 'LV', '029', 'Engures novads', 'Municipality',NULL),
('LV-030', 'LV', '030', 'Ērgļu novads', 'Municipality',NULL),
('LV-031', 'LV', '031', 'Garkalnes novads', 'Municipality',NULL),
('LV-032', 'LV', '032', 'Grobiņas novads', 'Municipality',NULL),
('LV-033', 'LV', '033', 'Gulbenes novads', 'Municipality',NULL),
('LV-034', 'LV', '034', 'Iecavas novads', 'Municipality',NULL),
('LV-035', 'LV', '035', 'Ikšķiles novads', 'Municipality',NULL),
('LV-036', 'LV', '036', 'Ilūkstes novads', 'Municipality',NULL),
('LV-037', 'LV', '037', 'Inčukalna novads', 'Municipality',NULL),
('LV-038', 'LV', '038', 'Jaunjelgavas novads', 'Municipality',NULL),
('LV-039', 'LV', '039', 'Jaunpiebalgas novads', 'Municipality',NULL),
('LV-040', 'LV', '040', 'Jaunpils novads', 'Municipality',NULL),
('LV-041', 'LV', '041', 'Jelgavas novads', 'Municipality',NULL),
('LV-042', 'LV', '042', 'Jēkabpils novads', 'Municipality',NULL),
('LV-043', 'LV', '043', 'Kandavas novads', 'Municipality',NULL),
('LV-044', 'LV', '044', 'Kārsavas novads', 'Municipality',NULL),
('LV-045', 'LV', '045', 'Kocēnu novads', 'Municipality',NULL),
('LV-046', 'LV', '046', 'Kokneses novads', 'Municipality',NULL),
('LV-047', 'LV', '047', 'Krāslavas novads', 'Municipality',NULL),
('LV-048', 'LV', '048', 'Krimuldas novads', 'Municipality',NULL),
('LV-049', 'LV', '049', 'Krustpils novads', 'Municipality',NULL),
('LV-050', 'LV', '050', 'Kuldīgas novads', 'Municipality',NULL),
('LV-051', 'LV', '051', 'Ķeguma novads', 'Municipality',NULL),
('LV-052', 'LV', '052', 'Ķekavas novads', 'Municipality',NULL),
('LV-053', 'LV', '053', 'Lielvārdes novads', 'Municipality',NULL),
('LV-054', 'LV', '054', 'Limbažu novads', 'Municipality',NULL),
('LV-055', 'LV', '055', 'Līgatnes novads', 'Municipality',NULL),
('LV-056', 'LV', '056', 'Līvānu novads', 'Municipality',NULL),
('LV-057', 'LV', '057', 'Lubānas novads', 'Municipality',NULL),
('LV-058', 'LV', '058', 'Ludzas novads', 'Municipality',NULL),
('LV-059', 'LV', '059', 'Madonas novads', 'Municipality',NULL),
('LV-060', 'LV', '060', 'Mazsalacas novads', 'Municipality',NULL),
('LV-061', 'LV', '061', 'Mālpils novads', 'Municipality',NULL),
('LV-062', 'LV', '062', 'Mārupes novads', 'Municipality',NULL),
('LV-063', 'LV', '063', 'Mērsraga novads', 'Municipality',NULL),
('LV-064', 'LV', '064', 'Naukšēnu novads', 'Municipality',NULL),
('LV-065', 'LV', '065', 'Neretas novads', 'Municipality',NULL),
('LV-066', 'LV', '066', 'Nīcas novads', 'Municipality',NULL),
('LV-067', 'LV', '067', 'Ogres novads', 'Municipality',NULL),
('LV-068', 'LV', '068', 'Olaines novads', 'Municipality',NULL),
('LV-069', 'LV', '069', 'Ozolnieku novads', 'Municipality',NULL),
('LV-070', 'LV', '070', 'Pārgaujas novads', 'Municipality',NULL),
('LV-071', 'LV', '071', 'Pāvilostas novads', 'Municipality',NULL),
('LV-072', 'LV', '072', 'Pļaviņu novads', 'Municipality',NULL),
('LV-073', 'LV', '073', 'Preiļu novads', 'Municipality',NULL),
('LV-074', 'LV', '074', 'Priekules novads', 'Municipality',NULL),
('LV-075', 'LV', '075', 'Priekuļu novads', 'Municipality',NULL),
('LV-076', 'LV', '076', 'Raunas novads', 'Municipality',NULL),
('LV-077', 'LV', '077', 'Rēzeknes novads', 'Municipality',NULL),
('LV-078', 'LV', '078', 'Riebiņu novads', 'Municipality',NULL),
('LV-079', 'LV', '079', 'Rojas novads', 'Municipality',NULL),
('LV-080', 'LV', '080', 'Ropažu novads', 'Municipality',NULL),
('LV-081', 'LV', '081', 'Rucavas novads', 'Municipality',NULL),
('LV-082', 'LV', '082', 'Rugāju novads', 'Municipality',NULL),
('LV-083', 'LV', '083', 'Rundāles novads', 'Municipality',NULL),
('LV-084', 'LV', '084', 'Rūjienas novads', 'Municipality',NULL),
('LV-085', 'LV', '085', 'Salas novads', 'Municipality',NULL),
('LV-086', 'LV', '086', 'Salacgrīvas novads', 'Municipality',NULL),
('LV-087', 'LV', '087', 'Salaspils novads', 'Municipality',NULL),
('LV-088', 'LV', '088', 'Saldus novads', 'Municipality',NULL),
('LV-089', 'LV', '089', 'Saulkrastu novads', 'Municipality',NULL),
('LV-090', 'LV', '090', 'Sējas novads', 'Municipality',NULL),
('LV-091', 'LV', '091', 'Siguldas novads', 'Municipality',NULL),
('LV-092', 'LV', '092', 'Skrīveru novads', 'Municipality',NULL),
('LV-093', 'LV', '093', 'Skrundas novads', 'Municipality',NULL),
('LV-094', 'LV', '094', 'Smiltenes novads', 'Municipality',NULL),
('LV-095', 'LV', '095', 'Stopiņu novads', 'Municipality',NULL),
('LV-096', 'LV', '096', 'Strenču novads', 'Municipality',NULL),
('LV-097', 'LV', '097', 'Talsu novads', 'Municipality',NULL),
('LV-098', 'LV', '098', 'Tērvetes novads', 'Municipality',NULL),
('LV-099', 'LV', '099', 'Tukuma novads', 'Municipality',NULL),
('LV-100', 'LV', '100', 'Vaiņodes novads', 'Municipality',NULL),
('LV-101', 'LV', '101', 'Valkas novads', 'Municipality',NULL),
('LV-102', 'LV', '102', 'Varakļānu novads', 'Municipality',NULL),
('LV-103', 'LV', '103', 'Vārkavas novads', 'Municipality',NULL),
('LV-104', 'LV', '104', 'Vecpiebalgas novads', 'Municipality',NULL),
('LV-105', 'LV', '105', 'Vecumnieku novads', 'Municipality',NULL),
('LV-106', 'LV', '106', 'Ventspils novads', 'Municipality',NULL),
('LV-107', 'LV', '107', 'Viesītes novads', 'Municipality',NULL),
('LV-108', 'LV', '108', 'Viļakas novads', 'Municipality',NULL),
('LV-109', 'LV', '109', 'Viļānu novads', 'Municipality',NULL),
('LV-110', 'LV', '110', 'Zilupes novads', 'Municipality',NULL),
('LV-DGV', 'LV', 'DGV', 'Daugavpils', 'Republican City',NULL),
('LV-JEL', 'LV', 'JEL', 'Jelgava', 'Republican City',NULL),
('LV-JKB', 'LV', 'JKB', 'Jēkabpils', 'Republican City',NULL),
('LV-JUR', 'LV', 'JUR', 'Jūrmala', 'Republican City',NULL),
('LV-LPX', 'LV', 'LPX', 'Liepāja', 'Republican City',NULL),
('LV-REZ', 'LV', 'REZ', 'Rēzekne', 'Republican City',NULL),
('LV-RIX', 'LV', 'RIX', 'Rīga', 'Republican City',NULL),
('LV-VMR', 'LV', 'VMR', 'Valmiera', 'Republican City',NULL),
('LV-VEN', 'LV', 'VEN', 'Ventspils', 'Republican City',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('LB', 'LBN', 'Lebanon', '', 'Lebanese Republic');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('LB-AK', 'LB', 'AK', 'Aakkâr', 'Governorate',NULL),
('LB-BH', 'LB', 'BH', 'Baalbek-Hermel', 'Governorate',NULL),
('LB-BI', 'LB', 'BI', 'Béqaa', 'Governorate',NULL),
('LB-BA', 'LB', 'BA', 'Beyrouth', 'Governorate',NULL),
('LB-AS', 'LB', 'AS', 'Liban-Nord', 'Governorate',NULL),
('LB-JA', 'LB', 'JA', 'Liban-Sud', 'Governorate',NULL),
('LB-JL', 'LB', 'JL', 'Mont-Liban', 'Governorate',NULL),
('LB-NA', 'LB', 'NA', 'Nabatîyé', 'Governorate',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('LS', 'LSO', 'Lesotho', '', 'Kingdom of Lesotho');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('LS-D', 'LS', 'D', 'Berea', 'District',NULL),
('LS-B', 'LS', 'B', 'Butha-Buthe', 'District',NULL),
('LS-C', 'LS', 'C', 'Leribe', 'District',NULL),
('LS-E', 'LS', 'E', 'Mafeteng', 'District',NULL),
('LS-A', 'LS', 'A', 'Maseru', 'District',NULL),
('LS-F', 'LS', 'F', 'Mohale''s Hoek', 'District',NULL),
('LS-J', 'LS', 'J', 'Mokhotlong', 'District',NULL),
('LS-H', 'LS', 'H', 'Qacha''s Nek', 'District',NULL),
('LS-G', 'LS', 'G', 'Quthing', 'District',NULL),
('LS-K', 'LS', 'K', 'Thaba-Tseka', 'District',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('LR', 'LBR', 'Liberia', '', 'Republic of Liberia');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('LR-BM', 'LR', 'BM', 'Bomi', 'County',NULL),
('LR-BG', 'LR', 'BG', 'Bong', 'County',NULL),
('LR-GB', 'LR', 'GB', 'Grand Bassa', 'County',NULL),
('LR-CM', 'LR', 'CM', 'Grand Cape Mount', 'County',NULL),
('LR-GG', 'LR', 'GG', 'Grand Gedeh', 'County',NULL),
('LR-GK', 'LR', 'GK', 'Grand Kru', 'County',NULL),
('LR-LO', 'LR', 'LO', 'Lofa', 'County',NULL),
('LR-MG', 'LR', 'MG', 'Margibi', 'County',NULL),
('LR-MY', 'LR', 'MY', 'Maryland', 'County',NULL),
('LR-MO', 'LR', 'MO', 'Montserrado', 'County',NULL),
('LR-NI', 'LR', 'NI', 'Nimba', 'County',NULL),
('LR-RI', 'LR', 'RI', 'Rivercess', 'County',NULL),
('LR-SI', 'LR', 'SI', 'Sinoe', 'County',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('LY', 'LBY', 'Libya', '', 'Libya');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('LY-BU', 'LY', 'BU', 'Al Buţnān', 'Popularates',NULL),
('LY-JA', 'LY', 'JA', 'Al Jabal al Akhḑar', 'Popularates',NULL),
('LY-JG', 'LY', 'JG', 'Al Jabal al Gharbī', 'Popularates',NULL),
('LY-JI', 'LY', 'JI', 'Al Jifārah', 'Popularates',NULL),
('LY-JU', 'LY', 'JU', 'Al Jufrah', 'Popularates',NULL),
('LY-KF', 'LY', 'KF', 'Al Kufrah', 'Popularates',NULL),
('LY-MJ', 'LY', 'MJ', 'Al Marj', 'Popularates',NULL),
('LY-MB', 'LY', 'MB', 'Al Marqab', 'Popularates',NULL),
('LY-WA', 'LY', 'WA', 'Al Wāḩāt', 'Popularates',NULL),
('LY-NQ', 'LY', 'NQ', 'An Nuqaţ al Khams', 'Popularates',NULL),
('LY-ZA', 'LY', 'ZA', 'Az Zāwiyah', 'Popularates',NULL),
('LY-BA', 'LY', 'BA', 'Banghāzī', 'Popularates',NULL),
('LY-DR', 'LY', 'DR', 'Darnah', 'Popularates',NULL),
('LY-GT', 'LY', 'GT', 'Ghāt', 'Popularates',NULL),
('LY-JB', 'LY', 'JB', 'Jaghbūb', 'Popularates',NULL),
('LY-MI', 'LY', 'MI', 'Mişrātah', 'Popularates',NULL),
('LY-MQ', 'LY', 'MQ', 'Murzuq', 'Popularates',NULL),
('LY-NL', 'LY', 'NL', 'Nālūt', 'Popularates',NULL),
('LY-SB', 'LY', 'SB', 'Sabhā', 'Popularates',NULL),
('LY-SR', 'LY', 'SR', 'Surt', 'Popularates',NULL),
('LY-TB', 'LY', 'TB', 'Ţarābulus', 'Popularates',NULL),
('LY-WD', 'LY', 'WD', 'Wādī al Ḩayāt', 'Popularates',NULL),
('LY-WS', 'LY', 'WS', 'Wādī ash Shāţiʾ', 'Popularates',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('LI', 'LIE', 'Liechtenstein', '', 'Principality of Liechtenstein');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('LI-01', 'LI', '01', 'Balzers', 'Commune',NULL),
('LI-02', 'LI', '02', 'Eschen', 'Commune',NULL),
('LI-03', 'LI', '03', 'Gamprin', 'Commune',NULL),
('LI-04', 'LI', '04', 'Mauren', 'Commune',NULL),
('LI-05', 'LI', '05', 'Planken', 'Commune',NULL),
('LI-06', 'LI', '06', 'Ruggell', 'Commune',NULL),
('LI-07', 'LI', '07', 'Schaan', 'Commune',NULL),
('LI-08', 'LI', '08', 'Schellenberg', 'Commune',NULL),
('LI-09', 'LI', '09', 'Triesen', 'Commune',NULL),
('LI-10', 'LI', '10', 'Triesenberg', 'Commune',NULL),
('LI-11', 'LI', '11', 'Vaduz', 'Commune',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('LT', 'LTU', 'Lithuania', '', 'Republic of Lithuania');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('LT-AL', 'LT', 'AL', 'Alytaus Apskritis', 'County',NULL),
('LT-KU', 'LT', 'KU', 'Kauno Apskritis', 'County',NULL),
('LT-KL', 'LT', 'KL', 'Klaipėdos Apskritis', 'County',NULL),
('LT-MR', 'LT', 'MR', 'Marijampolės Apskritis', 'County',NULL),
('LT-PN', 'LT', 'PN', 'Panevėžio Apskritis', 'County',NULL),
('LT-SA', 'LT', 'SA', 'Šiaulių Apskritis', 'County',NULL),
('LT-TA', 'LT', 'TA', 'Tauragés Apskritis', 'County',NULL),
('LT-TE', 'LT', 'TE', 'Telšių Apskritis', 'County',NULL),
('LT-UT', 'LT', 'UT', 'Utenos Apskritis', 'County',NULL),
('LT-VL', 'LT', 'VL', 'Vilniaus Apskritis', 'County',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('LU', 'LUX', 'Luxembourg', '', 'Grand Duchy of Luxembourg');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('LU-D', 'LU', 'D', 'Diekirch', 'District',NULL),
('LU-G', 'LU', 'G', 'Grevenmacher', 'District',NULL),
('LU-L', 'LU', 'L', 'Luxembourg', 'District',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('MO', 'MAC', 'Macao', '', 'Macao Special Administrative Region of China');

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('MK', 'MKD', 'Macedonia, Republic of', '', 'The Former Yugoslav Republic of Macedonia');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('MK-01', 'MK', '01', 'Aerodrom', 'Municipality',NULL),
('MK-02', 'MK', '02', 'Aračinovo', 'Municipality',NULL),
('MK-03', 'MK', '03', 'Berovo', 'Municipality',NULL),
('MK-04', 'MK', '04', 'Bitola', 'Municipality',NULL),
('MK-05', 'MK', '05', 'Bogdanci', 'Municipality',NULL),
('MK-06', 'MK', '06', 'Bogovinje', 'Municipality',NULL),
('MK-07', 'MK', '07', 'Bosilovo', 'Municipality',NULL),
('MK-08', 'MK', '08', 'Brvenica', 'Municipality',NULL),
('MK-09', 'MK', '09', 'Butel', 'Municipality',NULL),
('MK-77', 'MK', '77', 'Centar', 'Municipality',NULL),
('MK-78', 'MK', '78', 'Centar Župa', 'Municipality',NULL),
('MK-79', 'MK', '79', 'Čair', 'Municipality',NULL),
('MK-80', 'MK', '80', 'Čaška', 'Municipality',NULL),
('MK-81', 'MK', '81', 'Češinovo-Obleševo', 'Municipality',NULL),
('MK-82', 'MK', '82', 'Čučer Sandevo', 'Municipality',NULL),
('MK-21', 'MK', '21', 'Debar', 'Municipality',NULL),
('MK-22', 'MK', '22', 'Debarca', 'Municipality',NULL),
('MK-23', 'MK', '23', 'Delčevo', 'Municipality',NULL),
('MK-25', 'MK', '25', 'Demir Hisar', 'Municipality',NULL),
('MK-24', 'MK', '24', 'Demir Kapija', 'Municipality',NULL),
('MK-26', 'MK', '26', 'Dojran', 'Municipality',NULL),
('MK-27', 'MK', '27', 'Dolneni', 'Municipality',NULL),
('MK-28', 'MK', '28', 'Drugovo', 'Municipality',NULL),
('MK-17', 'MK', '17', 'Gazi Baba', 'Municipality',NULL),
('MK-18', 'MK', '18', 'Gevgelija', 'Municipality',NULL),
('MK-29', 'MK', '29', 'Gjorče Petrov', 'Municipality',NULL),
('MK-19', 'MK', '19', 'Gostivar', 'Municipality',NULL),
('MK-20', 'MK', '20', 'Gradsko', 'Municipality',NULL),
('MK-34', 'MK', '34', 'Ilinden', 'Municipality',NULL),
('MK-35', 'MK', '35', 'Jegunovce', 'Municipality',NULL),
('MK-37', 'MK', '37', 'Karbinci', 'Municipality',NULL),
('MK-38', 'MK', '38', 'Karpoš', 'Municipality',NULL),
('MK-36', 'MK', '36', 'Kavadarci', 'Municipality',NULL),
('MK-40', 'MK', '40', 'Kičevo', 'Municipality',NULL),
('MK-39', 'MK', '39', 'Kisela Voda', 'Municipality',NULL),
('MK-42', 'MK', '42', 'Kočani', 'Municipality',NULL),
('MK-41', 'MK', '41', 'Konče', 'Municipality',NULL),
('MK-43', 'MK', '43', 'Kratovo', 'Municipality',NULL),
('MK-44', 'MK', '44', 'Kriva Palanka', 'Municipality',NULL),
('MK-45', 'MK', '45', 'Krivogaštani', 'Municipality',NULL),
('MK-46', 'MK', '46', 'Kruševo', 'Municipality',NULL),
('MK-47', 'MK', '47', 'Kumanovo', 'Municipality',NULL),
('MK-48', 'MK', '48', 'Lipkovo', 'Municipality',NULL),
('MK-49', 'MK', '49', 'Lozovo', 'Municipality',NULL),
('MK-51', 'MK', '51', 'Makedonska Kamenica', 'Municipality',NULL),
('MK-52', 'MK', '52', 'Makedonski Brod', 'Municipality',NULL),
('MK-50', 'MK', '50', 'Mavrovo-i-Rostuša', 'Municipality',NULL),
('MK-53', 'MK', '53', 'Mogila', 'Municipality',NULL),
('MK-54', 'MK', '54', 'Negotino', 'Municipality',NULL),
('MK-55', 'MK', '55', 'Novaci', 'Municipality',NULL),
('MK-56', 'MK', '56', 'Novo Selo', 'Municipality',NULL),
('MK-58', 'MK', '58', 'Ohrid', 'Municipality',NULL),
('MK-57', 'MK', '57', 'Oslomej', 'Municipality',NULL),
('MK-60', 'MK', '60', 'Pehčevo', 'Municipality',NULL),
('MK-59', 'MK', '59', 'Petrovec', 'Municipality',NULL),
('MK-61', 'MK', '61', 'Plasnica', 'Municipality',NULL),
('MK-62', 'MK', '62', 'Prilep', 'Municipality',NULL),
('MK-63', 'MK', '63', 'Probištip', 'Municipality',NULL),
('MK-64', 'MK', '64', 'Radoviš', 'Municipality',NULL),
('MK-65', 'MK', '65', 'Rankovce', 'Municipality',NULL),
('MK-66', 'MK', '66', 'Resen', 'Municipality',NULL),
('MK-67', 'MK', '67', 'Rosoman', 'Municipality',NULL),
('MK-68', 'MK', '68', 'Saraj', 'Municipality',NULL),
('MK-70', 'MK', '70', 'Sopište', 'Municipality',NULL),
('MK-71', 'MK', '71', 'Staro Nagoričane', 'Municipality',NULL),
('MK-72', 'MK', '72', 'Struga', 'Municipality',NULL),
('MK-73', 'MK', '73', 'Strumica', 'Municipality',NULL),
('MK-74', 'MK', '74', 'Studeničani', 'Municipality',NULL),
('MK-69', 'MK', '69', 'Sveti Nikole', 'Municipality',NULL),
('MK-83', 'MK', '83', 'Štip', 'Municipality',NULL),
('MK-84', 'MK', '84', 'Šuto Orizari', 'Municipality',NULL),
('MK-75', 'MK', '75', 'Tearce', 'Municipality',NULL),
('MK-76', 'MK', '76', 'Tetovo', 'Municipality',NULL),
('MK-10', 'MK', '10', 'Valandovo', 'Municipality',NULL),
('MK-11', 'MK', '11', 'Vasilevo', 'Municipality',NULL),
('MK-13', 'MK', '13', 'Veles', 'Municipality',NULL),
('MK-12', 'MK', '12', 'Vevčani', 'Municipality',NULL),
('MK-14', 'MK', '14', 'Vinica', 'Municipality',NULL),
('MK-15', 'MK', '15', 'Vraneštica', 'Municipality',NULL),
('MK-16', 'MK', '16', 'Vrapčište', 'Municipality',NULL),
('MK-31', 'MK', '31', 'Zajas', 'Municipality',NULL),
('MK-32', 'MK', '32', 'Zelenikovo', 'Municipality',NULL),
('MK-33', 'MK', '33', 'Zrnovci', 'Municipality',NULL),
('MK-30', 'MK', '30', 'Želino', 'Municipality',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('MG', 'MDG', 'Madagascar', '', 'Republic of Madagascar');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('MG-T', 'MG', 'T', 'Antananarivo', 'Autonomous province',NULL),
('MG-D', 'MG', 'D', 'Antsiranana', 'Autonomous province',NULL),
('MG-F', 'MG', 'F', 'Fianarantsoa', 'Autonomous province',NULL),
('MG-M', 'MG', 'M', 'Mahajanga', 'Autonomous province',NULL),
('MG-A', 'MG', 'A', 'Toamasina', 'Autonomous province',NULL),
('MG-U', 'MG', 'U', 'Toliara', 'Autonomous province',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('MW', 'MWI', 'Malawi', '', 'Republic of Malawi');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('MW-C', 'MW', 'C', 'Central Region', 'Region',NULL),
('MW-N', 'MW', 'N', 'Northern Region', 'Region',NULL),
('MW-S', 'MW', 'S', 'Southern Region', 'Region',NULL),
('MW-BA', 'MW', 'BA', 'Balaka', 'District','MW-S'),
('MW-BL', 'MW', 'BL', 'Blantyre', 'District','MW-S'),
('MW-CK', 'MW', 'CK', 'Chikwawa', 'District','MW-S'),
('MW-CR', 'MW', 'CR', 'Chiradzulu', 'District','MW-S'),
('MW-CT', 'MW', 'CT', 'Chitipa', 'District','MW-N'),
('MW-DE', 'MW', 'DE', 'Dedza', 'District','MW-C'),
('MW-DO', 'MW', 'DO', 'Dowa', 'District','MW-C'),
('MW-KR', 'MW', 'KR', 'Karonga', 'District','MW-N'),
('MW-KS', 'MW', 'KS', 'Kasungu', 'District','MW-C'),
('MW-LK', 'MW', 'LK', 'Likoma', 'District','MW-N'),
('MW-LI', 'MW', 'LI', 'Lilongwe', 'District','MW-C'),
('MW-MH', 'MW', 'MH', 'Machinga', 'District','MW-S'),
('MW-MG', 'MW', 'MG', 'Mangochi', 'District','MW-S'),
('MW-MC', 'MW', 'MC', 'Mchinji', 'District','MW-C'),
('MW-MU', 'MW', 'MU', 'Mulanje', 'District','MW-S'),
('MW-MW', 'MW', 'MW', 'Mwanza', 'District','MW-S'),
('MW-MZ', 'MW', 'MZ', 'Mzimba', 'District','MW-N'),
('MW-NE', 'MW', 'NE', 'Neno', 'District','MW-N'),
('MW-NB', 'MW', 'NB', 'Nkhata Bay', 'District','MW-N'),
('MW-NK', 'MW', 'NK', 'Nkhotakota', 'District','MW-C'),
('MW-NS', 'MW', 'NS', 'Nsanje', 'District','MW-S'),
('MW-NU', 'MW', 'NU', 'Ntcheu', 'District','MW-C'),
('MW-NI', 'MW', 'NI', 'Ntchisi', 'District','MW-C'),
('MW-PH', 'MW', 'PH', 'Phalombe', 'District','MW-S'),
('MW-RU', 'MW', 'RU', 'Rumphi', 'District','MW-N'),
('MW-SA', 'MW', 'SA', 'Salima', 'District','MW-C'),
('MW-TH', 'MW', 'TH', 'Thyolo', 'District','MW-S'),
('MW-ZO', 'MW', 'ZO', 'Zomba', 'District','MW-S');

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('MY', 'MYS', 'Malaysia', '', '');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('MY-14', 'MY', '14', 'Wilayah Persekutuan Kuala Lumpur', 'Federal Territories',NULL),
('MY-15', 'MY', '15', 'Wilayah Persekutuan Labuan', 'Federal Territories',NULL),
('MY-16', 'MY', '16', 'Wilayah Persekutuan Putrajaya', 'Federal Territories',NULL),
('MY-01', 'MY', '01', 'Johor', 'State',NULL),
('MY-02', 'MY', '02', 'Kedah', 'State',NULL),
('MY-03', 'MY', '03', 'Kelantan', 'State',NULL),
('MY-04', 'MY', '04', 'Melaka', 'State',NULL),
('MY-05', 'MY', '05', 'Negeri Sembilan', 'State',NULL),
('MY-06', 'MY', '06', 'Pahang', 'State',NULL),
('MY-08', 'MY', '08', 'Perak', 'State',NULL),
('MY-09', 'MY', '09', 'Perlis', 'State',NULL),
('MY-07', 'MY', '07', 'Pulau Pinang', 'State',NULL),
('MY-12', 'MY', '12', 'Sabah', 'State',NULL),
('MY-13', 'MY', '13', 'Sarawak', 'State',NULL),
('MY-10', 'MY', '10', 'Selangor', 'State',NULL),
('MY-11', 'MY', '11', 'Terengganu', 'State',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('MV', 'MDV', 'Maldives', '', 'Republic of Maldives');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('MV-MLE', 'MV', 'MLE', 'Male', 'City',NULL),
('MV-SU', 'MV', 'SU', 'South', 'Province',NULL),
('MV-US', 'MV', 'US', 'Upper South', 'Province',NULL),
('MV-UN', 'MV', 'UN', 'Upper North', 'Province',NULL),
('MV-CE', 'MV', 'CE', 'Central', 'Province',NULL),
('MV-SC', 'MV', 'SC', 'South Central', 'Province',NULL),
('MV-NC', 'MV', 'NC', 'North Central', 'Province',NULL),
('MV-NO', 'MV', 'NO', 'North', 'Province',NULL),
('MV-02', 'MV', '02', 'Alifu Alifu', 'Administrative atoll','MV-NC'),
('MV-00', 'MV', '00', 'Alifu Dhaalu', 'Administrative atoll','MV-NC'),
('MV-20', 'MV', '20', 'Baa', 'Administrative atoll','MV-NO'),
('MV-17', 'MV', '17', 'Dhaalu', 'Administrative atoll','MV-CE'),
('MV-14', 'MV', '14', 'Faafu', 'Administrative atoll','MV-CE'),
('MV-27', 'MV', '27', 'Gaafu Alifu', 'Administrative atoll','MV-SC'),
('MV-28', 'MV', '28', 'Gaafu Dhaalu', 'Administrative atoll','MV-SC'),
('MV-29', 'MV', '29', 'Gnaviyani', 'Administrative atoll','MV-SU'),
('MV-07', 'MV', '07', 'Haa Alifu', 'Administrative atoll','MV-UN'),
('MV-23', 'MV', '23', 'Haa Dhaalu', 'Administrative atoll','MV-UN'),
('MV-26', 'MV', '26', 'Kaafu', 'Administrative atoll','MV-NC'),
('MV-05', 'MV', '05', 'Laamu', 'Administrative atoll','MV-US'),
('MV-03', 'MV', '03', 'Lhaviyani', 'Administrative atoll','MV-NO'),
('MV-12', 'MV', '12', 'Meemu', 'Administrative atoll','MV-CE'),
('MV-25', 'MV', '25', 'Noonu', 'Administrative atoll','MV-NO'),
('MV-13', 'MV', '13', 'Raa', 'Administrative atoll','MV-NO'),
('MV-01', 'MV', '01', 'Seenu', 'Administrative atoll','MV-SU'),
('MV-24', 'MV', '24', 'Shaviyani', 'Administrative atoll','MV-UN'),
('MV-08', 'MV', '08', 'Thaa', 'Administrative atoll','MV-US'),
('MV-04', 'MV', '04', 'Vaavu', 'Administrative atoll','MV-NC');

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('ML', 'MLI', 'Mali', '', 'Republic of Mali');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('ML-BK0', 'ML', 'BK0', 'Bamako', 'District',NULL),
('ML-7', 'ML', '7', 'Gao', 'Region',NULL),
('ML-1', 'ML', '1', 'Kayes', 'Region',NULL),
('ML-8', 'ML', '8', 'Kidal', 'Region',NULL),
('ML-2', 'ML', '2', 'Koulikoro', 'Region',NULL),
('ML-5', 'ML', '5', 'Mopti', 'Region',NULL),
('ML-4', 'ML', '4', 'Ségou', 'Region',NULL),
('ML-3', 'ML', '3', 'Sikasso', 'Region',NULL),
('ML-6', 'ML', '6', 'Tombouctou', 'Region',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('MT', 'MLT', 'Malta', '', 'Republic of Malta');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('MT-01', 'MT', '01', 'Attard', 'Local council',NULL),
('MT-02', 'MT', '02', 'Balzan', 'Local council',NULL),
('MT-03', 'MT', '03', 'Birgu', 'Local council',NULL),
('MT-04', 'MT', '04', 'Birkirkara', 'Local council',NULL),
('MT-05', 'MT', '05', 'Birżebbuġa', 'Local council',NULL),
('MT-06', 'MT', '06', 'Bormla', 'Local council',NULL),
('MT-07', 'MT', '07', 'Dingli', 'Local council',NULL),
('MT-08', 'MT', '08', 'Fgura', 'Local council',NULL),
('MT-09', 'MT', '09', 'Floriana', 'Local council',NULL),
('MT-10', 'MT', '10', 'Fontana', 'Local council',NULL),
('MT-11', 'MT', '11', 'Gudja', 'Local council',NULL),
('MT-12', 'MT', '12', 'Gżira', 'Local council',NULL),
('MT-13', 'MT', '13', 'Għajnsielem', 'Local council',NULL),
('MT-14', 'MT', '14', 'Għarb', 'Local council',NULL),
('MT-15', 'MT', '15', 'Għargħur', 'Local council',NULL),
('MT-16', 'MT', '16', 'Għasri', 'Local council',NULL),
('MT-17', 'MT', '17', 'Għaxaq', 'Local council',NULL),
('MT-18', 'MT', '18', 'Ħamrun', 'Local council',NULL),
('MT-19', 'MT', '19', 'Iklin', 'Local council',NULL),
('MT-20', 'MT', '20', 'Isla', 'Local council',NULL),
('MT-21', 'MT', '21', 'Kalkara', 'Local council',NULL),
('MT-22', 'MT', '22', 'Kerċem', 'Local council',NULL),
('MT-23', 'MT', '23', 'Kirkop', 'Local council',NULL),
('MT-24', 'MT', '24', 'Lija', 'Local council',NULL),
('MT-25', 'MT', '25', 'Luqa', 'Local council',NULL),
('MT-26', 'MT', '26', 'Marsa', 'Local council',NULL),
('MT-27', 'MT', '27', 'Marsaskala', 'Local council',NULL),
('MT-28', 'MT', '28', 'Marsaxlokk', 'Local council',NULL),
('MT-29', 'MT', '29', 'Mdina', 'Local council',NULL),
('MT-30', 'MT', '30', 'Mellieħa', 'Local council',NULL),
('MT-31', 'MT', '31', 'Mġarr', 'Local council',NULL),
('MT-32', 'MT', '32', 'Mosta', 'Local council',NULL),
('MT-33', 'MT', '33', 'Mqabba', 'Local council',NULL),
('MT-34', 'MT', '34', 'Msida', 'Local council',NULL),
('MT-35', 'MT', '35', 'Mtarfa', 'Local council',NULL),
('MT-36', 'MT', '36', 'Munxar', 'Local council',NULL),
('MT-37', 'MT', '37', 'Nadur', 'Local council',NULL),
('MT-38', 'MT', '38', 'Naxxar', 'Local council',NULL),
('MT-39', 'MT', '39', 'Paola', 'Local council',NULL),
('MT-40', 'MT', '40', 'Pembroke', 'Local council',NULL),
('MT-41', 'MT', '41', 'Pietà', 'Local council',NULL),
('MT-42', 'MT', '42', 'Qala', 'Local council',NULL),
('MT-43', 'MT', '43', 'Qormi', 'Local council',NULL),
('MT-44', 'MT', '44', 'Qrendi', 'Local council',NULL),
('MT-45', 'MT', '45', 'Rabat Għawdex', 'Local council',NULL),
('MT-46', 'MT', '46', 'Rabat Malta', 'Local council',NULL),
('MT-47', 'MT', '47', 'Safi', 'Local council',NULL),
('MT-48', 'MT', '48', 'San Ġiljan', 'Local council',NULL),
('MT-49', 'MT', '49', 'San Ġwann', 'Local council',NULL),
('MT-50', 'MT', '50', 'San Lawrenz', 'Local council',NULL),
('MT-51', 'MT', '51', 'San Pawl il-Baħar', 'Local council',NULL),
('MT-52', 'MT', '52', 'Sannat', 'Local council',NULL),
('MT-53', 'MT', '53', 'Santa Luċija', 'Local council',NULL),
('MT-54', 'MT', '54', 'Santa Venera', 'Local council',NULL),
('MT-55', 'MT', '55', 'Siġġiewi', 'Local council',NULL),
('MT-56', 'MT', '56', 'Sliema', 'Local council',NULL),
('MT-57', 'MT', '57', 'Swieqi', 'Local council',NULL),
('MT-58', 'MT', '58', 'Ta’ Xbiex', 'Local council',NULL),
('MT-59', 'MT', '59', 'Tarxien', 'Local council',NULL),
('MT-60', 'MT', '60', 'Valletta', 'Local council',NULL),
('MT-61', 'MT', '61', 'Xagħra', 'Local council',NULL),
('MT-62', 'MT', '62', 'Xewkija', 'Local council',NULL),
('MT-63', 'MT', '63', 'Xgħajra', 'Local council',NULL),
('MT-64', 'MT', '64', 'Żabbar', 'Local council',NULL),
('MT-65', 'MT', '65', 'Żebbuġ Għawdex', 'Local council',NULL),
('MT-66', 'MT', '66', 'Żebbuġ Malta', 'Local council',NULL),
('MT-67', 'MT', '67', 'Żejtun', 'Local council',NULL),
('MT-68', 'MT', '68', 'Żurrieq', 'Local council',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('MH', 'MHL', 'Marshall Islands', '', 'Republic of the Marshall Islands');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('MH-L', 'MH', 'L', 'Ralik chain', 'Chains (of islands)',NULL),
('MH-T', 'MH', 'T', 'Ratak chain', 'Chains (of islands)',NULL),
('MH-ALL', 'MH', 'ALL', 'Ailinglaplap', 'Municipality','MH-L'),
('MH-ALK', 'MH', 'ALK', 'Ailuk', 'Municipality','MH-T'),
('MH-ARN', 'MH', 'ARN', 'Arno', 'Municipality','MH-T'),
('MH-AUR', 'MH', 'AUR', 'Aur', 'Municipality','MH-T'),
('MH-EBO', 'MH', 'EBO', 'Ebon', 'Municipality','MH-L'),
('MH-ENI', 'MH', 'ENI', 'Enewetak', 'Municipality','MH-L'),
('MH-JAB', 'MH', 'JAB', 'Jabat', 'Municipality','MH-L'),
('MH-JAL', 'MH', 'JAL', 'Jaluit', 'Municipality','MH-L'),
('MH-KIL', 'MH', 'KIL', 'Kili', 'Municipality','MH-L'),
('MH-KWA', 'MH', 'KWA', 'Kwajalein', 'Municipality','MH-L'),
('MH-LAE', 'MH', 'LAE', 'Lae', 'Municipality','MH-L'),
('MH-LIB', 'MH', 'LIB', 'Lib', 'Municipality','MH-L'),
('MH-LIK', 'MH', 'LIK', 'Likiep', 'Municipality','MH-T'),
('MH-MAJ', 'MH', 'MAJ', 'Majuro', 'Municipality','MH-T'),
('MH-MAL', 'MH', 'MAL', 'Maloelap', 'Municipality','MH-T'),
('MH-MEJ', 'MH', 'MEJ', 'Mejit', 'Municipality','MH-T'),
('MH-MIL', 'MH', 'MIL', 'Mili', 'Municipality','MH-T'),
('MH-NMK', 'MH', 'NMK', 'Namdrik', 'Municipality','MH-L'),
('MH-NMU', 'MH', 'NMU', 'Namu', 'Municipality','MH-L'),
('MH-RON', 'MH', 'RON', 'Rongelap', 'Municipality','MH-L'),
('MH-UJA', 'MH', 'UJA', 'Ujae', 'Municipality','MH-L'),
('MH-UTI', 'MH', 'UTI', 'Utirik', 'Municipality','MH-T'),
('MH-WTN', 'MH', 'WTN', 'Wotho', 'Municipality','MH-L'),
('MH-WTJ', 'MH', 'WTJ', 'Wotje', 'Municipality','MH-T');

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('MQ', 'MTQ', 'Martinique', '', '');

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('MR', 'MRT', 'Mauritania', '', 'Islamic Republic of Mauritania');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('MR-NKC', 'MR', 'NKC', 'Nouakchott', 'District',NULL),
('MR-07', 'MR', '07', 'Adrar', 'Region',NULL),
('MR-03', 'MR', '03', 'Assaba', 'Region',NULL),
('MR-05', 'MR', '05', 'Brakna', 'Region',NULL),
('MR-08', 'MR', '08', 'Dakhlet Nouadhibou', 'Region',NULL),
('MR-04', 'MR', '04', 'Gorgol', 'Region',NULL),
('MR-10', 'MR', '10', 'Guidimaka', 'Region',NULL),
('MR-01', 'MR', '01', 'Hodh ech Chargui', 'Region',NULL),
('MR-02', 'MR', '02', 'Hodh el Charbi', 'Region',NULL),
('MR-12', 'MR', '12', 'Inchiri', 'Region',NULL),
('MR-09', 'MR', '09', 'Tagant', 'Region',NULL),
('MR-11', 'MR', '11', 'Tiris Zemmour', 'Region',NULL),
('MR-06', 'MR', '06', 'Trarza', 'Region',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('MU', 'MUS', 'Mauritius', '', 'Republic of Mauritius');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('MU-BR', 'MU', 'BR', 'Beau Bassin-Rose Hill', 'City',NULL),
('MU-CU', 'MU', 'CU', 'Curepipe', 'City',NULL),
('MU-PU', 'MU', 'PU', 'Port Louis', 'City',NULL),
('MU-QB', 'MU', 'QB', 'Quatre Bornes', 'City',NULL),
('MU-VP', 'MU', 'VP', 'Vacoas-Phoenix', 'City',NULL),
('MU-AG', 'MU', 'AG', 'Agalega Islands', 'Dependency',NULL),
('MU-CC', 'MU', 'CC', 'Cargados Carajos Shoals', 'Dependency',NULL),
('MU-RO', 'MU', 'RO', 'Rodrigues Island', 'Dependency',NULL),
('MU-BL', 'MU', 'BL', 'Black River', 'District',NULL),
('MU-FL', 'MU', 'FL', 'Flacq', 'District',NULL),
('MU-GP', 'MU', 'GP', 'Grand Port', 'District',NULL),
('MU-MO', 'MU', 'MO', 'Moka', 'District',NULL),
('MU-PA', 'MU', 'PA', 'Pamplemousses', 'District',NULL),
('MU-PW', 'MU', 'PW', 'Plaines Wilhems', 'District',NULL),
('MU-PL', 'MU', 'PL', 'Port Louis', 'District',NULL),
('MU-RP', 'MU', 'RP', 'Rivière du Rempart', 'District',NULL),
('MU-SA', 'MU', 'SA', 'Savanne', 'District',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('YT', 'MYT', 'Mayotte', '', '');

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('MX', 'MEX', 'Mexico', '', 'United Mexican States');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('MX-DIF', 'MX', 'DIF', 'Distrito Federal', 'Federal district',NULL),
('MX-AGU', 'MX', 'AGU', 'Aguascalientes', 'State',NULL),
('MX-BCN', 'MX', 'BCN', 'Baja California', 'State',NULL),
('MX-BCS', 'MX', 'BCS', 'Baja California Sur', 'State',NULL),
('MX-CAM', 'MX', 'CAM', 'Campeche', 'State',NULL),
('MX-COA', 'MX', 'COA', 'Coahuila', 'State',NULL),
('MX-COL', 'MX', 'COL', 'Colima', 'State',NULL),
('MX-CHP', 'MX', 'CHP', 'Chiapas', 'State',NULL),
('MX-CHH', 'MX', 'CHH', 'Chihuahua', 'State',NULL),
('MX-DUR', 'MX', 'DUR', 'Durango', 'State',NULL),
('MX-GUA', 'MX', 'GUA', 'Guanajuato', 'State',NULL),
('MX-GRO', 'MX', 'GRO', 'Guerrero', 'State',NULL),
('MX-HID', 'MX', 'HID', 'Hidalgo', 'State',NULL),
('MX-JAL', 'MX', 'JAL', 'Jalisco', 'State',NULL),
('MX-MEX', 'MX', 'MEX', 'México', 'State',NULL),
('MX-MIC', 'MX', 'MIC', 'Michoacán', 'State',NULL),
('MX-MOR', 'MX', 'MOR', 'Morelos', 'State',NULL),
('MX-NAY', 'MX', 'NAY', 'Nayarit', 'State',NULL),
('MX-NLE', 'MX', 'NLE', 'Nuevo León', 'State',NULL),
('MX-OAX', 'MX', 'OAX', 'Oaxaca', 'State',NULL),
('MX-PUE', 'MX', 'PUE', 'Puebla', 'State',NULL),
('MX-QUE', 'MX', 'QUE', 'Querétaro', 'State',NULL),
('MX-ROO', 'MX', 'ROO', 'Quintana Roo', 'State',NULL),
('MX-SLP', 'MX', 'SLP', 'San Luis Potosí', 'State',NULL),
('MX-SIN', 'MX', 'SIN', 'Sinaloa', 'State',NULL),
('MX-SON', 'MX', 'SON', 'Sonora', 'State',NULL),
('MX-TAB', 'MX', 'TAB', 'Tabasco', 'State',NULL),
('MX-TAM', 'MX', 'TAM', 'Tamaulipas', 'State',NULL),
('MX-TLA', 'MX', 'TLA', 'Tlaxcala', 'State',NULL),
('MX-VER', 'MX', 'VER', 'Veracruz', 'State',NULL),
('MX-YUC', 'MX', 'YUC', 'Yucatán', 'State',NULL),
('MX-ZAC', 'MX', 'ZAC', 'Zacatecas', 'State',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('FM', 'FSM', 'Micronesia, Federated States of', '', 'Federated States of Micronesia');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('FM-TRK', 'FM', 'TRK', 'Chuuk', 'State',NULL),
('FM-KSA', 'FM', 'KSA', 'Kosrae', 'State',NULL),
('FM-PNI', 'FM', 'PNI', 'Pohnpei', 'State',NULL),
('FM-YAP', 'FM', 'YAP', 'Yap', 'State',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('MD', 'MDA', 'Moldova, Republic of', 'Moldova', 'Republic of Moldova');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('MD-GA', 'MD', 'GA', 'Găgăuzia, Unitatea teritorială autonomă', 'Autonomous territorial unit',NULL),
('MD-BA', 'MD', 'BA', 'Bălți', 'City',NULL),
('MD-BD', 'MD', 'BD', 'Tighina', 'City',NULL),
('MD-CU', 'MD', 'CU', 'Chișinău', 'City',NULL),
('MD-AN', 'MD', 'AN', 'Anenii Noi', 'District',NULL),
('MD-BS', 'MD', 'BS', 'Basarabeasca', 'District',NULL),
('MD-BR', 'MD', 'BR', 'Briceni', 'District',NULL),
('MD-CA', 'MD', 'CA', 'Cahul', 'District',NULL),
('MD-CT', 'MD', 'CT', 'Cantemir', 'District',NULL),
('MD-CL', 'MD', 'CL', 'Călărași', 'District',NULL),
('MD-CS', 'MD', 'CS', 'Căușeni', 'District',NULL),
('MD-CM', 'MD', 'CM', 'Cimișlia', 'District',NULL),
('MD-CR', 'MD', 'CR', 'Criuleni', 'District',NULL),
('MD-DO', 'MD', 'DO', 'Dondușeni', 'District',NULL),
('MD-DR', 'MD', 'DR', 'Drochia', 'District',NULL),
('MD-DU', 'MD', 'DU', 'Dubăsari', 'District',NULL),
('MD-ED', 'MD', 'ED', 'Edineț', 'District',NULL),
('MD-FA', 'MD', 'FA', 'Fălești', 'District',NULL),
('MD-FL', 'MD', 'FL', 'Florești', 'District',NULL),
('MD-GL', 'MD', 'GL', 'Glodeni', 'District',NULL),
('MD-HI', 'MD', 'HI', 'Hîncești', 'District',NULL),
('MD-IA', 'MD', 'IA', 'Ialoveni', 'District',NULL),
('MD-LE', 'MD', 'LE', 'Leova', 'District',NULL),
('MD-NI', 'MD', 'NI', 'Nisporeni', 'District',NULL),
('MD-OC', 'MD', 'OC', 'Ocnița', 'District',NULL),
('MD-OR', 'MD', 'OR', 'Orhei', 'District',NULL),
('MD-RE', 'MD', 'RE', 'Rezina', 'District',NULL),
('MD-RI', 'MD', 'RI', 'Rîșcani', 'District',NULL),
('MD-SI', 'MD', 'SI', 'Sîngerei', 'District',NULL),
('MD-SO', 'MD', 'SO', 'Soroca', 'District',NULL),
('MD-ST', 'MD', 'ST', 'Strășeni', 'District',NULL),
('MD-SD', 'MD', 'SD', 'Șoldănești', 'District',NULL),
('MD-SV', 'MD', 'SV', 'Ștefan Vodă', 'District',NULL),
('MD-TA', 'MD', 'TA', 'Taraclia', 'District',NULL),
('MD-TE', 'MD', 'TE', 'Telenești', 'District',NULL),
('MD-UN', 'MD', 'UN', 'Ungheni', 'District',NULL),
('MD-SN', 'MD', 'SN', 'Stînga Nistrului, unitatea teritorială din', 'Territorial unit',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('MC', 'MCO', 'Monaco', '', 'Principality of Monaco');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('MC-CO', 'MC', 'CO', 'La Condamine', 'Quarter',NULL),
('MC-FO', 'MC', 'FO', 'Fontvieille', 'Quarter',NULL),
('MC-JE', 'MC', 'JE', 'Jardin Exotique', 'Quarter',NULL),
('MC-CL', 'MC', 'CL', 'La Colle', 'Quarter',NULL),
('MC-GA', 'MC', 'GA', 'La Gare', 'Quarter',NULL),
('MC-SO', 'MC', 'SO', 'La Source', 'Quarter',NULL),
('MC-LA', 'MC', 'LA', 'Larvotto', 'Quarter',NULL),
('MC-MA', 'MC', 'MA', 'Malbousquet', 'Quarter',NULL),
('MC-MO', 'MC', 'MO', 'Monaco-Ville', 'Quarter',NULL),
('MC-MG', 'MC', 'MG', 'Moneghetti', 'Quarter',NULL),
('MC-MC', 'MC', 'MC', 'Monte-Carlo', 'Quarter',NULL),
('MC-MU', 'MC', 'MU', 'Moulins', 'Quarter',NULL),
('MC-PH', 'MC', 'PH', 'Port-Hercule', 'Quarter',NULL),
('MC-SR', 'MC', 'SR', 'Saint-Roman', 'Quarter',NULL),
('MC-SD', 'MC', 'SD', 'Sainte-Dévote', 'Quarter',NULL),
('MC-SP', 'MC', 'SP', 'Spélugues', 'Quarter',NULL),
('MC-VR', 'MC', 'VR', 'Vallon de la Rousse', 'Quarter',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('MN', 'MNG', 'Mongolia', '', '');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('MN-073', 'MN', '073', 'Arhangay', 'Province',NULL),
('MN-069', 'MN', '069', 'Bayanhongor', 'Province',NULL),
('MN-071', 'MN', '071', 'Bayan-Ölgiy', 'Province',NULL),
('MN-067', 'MN', '067', 'Bulgan', 'Province',NULL),
('MN-061', 'MN', '061', 'Dornod', 'Province',NULL),
('MN-063', 'MN', '063', 'Dornogovi', 'Province',NULL),
('MN-059', 'MN', '059', 'Dundgovi', 'Province',NULL),
('MN-057', 'MN', '057', 'Dzavhan', 'Province',NULL),
('MN-065', 'MN', '065', 'Govi-Altay', 'Province',NULL),
('MN-039', 'MN', '039', 'Hentiy', 'Province',NULL),
('MN-043', 'MN', '043', 'Hovd', 'Province',NULL),
('MN-041', 'MN', '041', 'Hövsgöl', 'Province',NULL),
('MN-053', 'MN', '053', 'Ömnögovi', 'Province',NULL),
('MN-055', 'MN', '055', 'Övörhangay', 'Province',NULL),
('MN-049', 'MN', '049', 'Selenge', 'Province',NULL),
('MN-051', 'MN', '051', 'Sühbaatar', 'Province',NULL),
('MN-047', 'MN', '047', 'Töv', 'Province',NULL),
('MN-046', 'MN', '046', 'Uvs', 'Province',NULL),
('MN-1', 'MN', '1', 'Ulanbaatar', 'Municipality',NULL),
('MN-037', 'MN', '037', 'Darhan uul', 'Municipality',NULL),
('MN-064', 'MN', '064', 'Govi-Sumber', 'Municipality',NULL),
('MN-035', 'MN', '035', 'Orhon', 'Municipality',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('ME', 'MNE', 'Montenegro', '', 'Montenegro');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('ME-01', 'ME', '01', 'Andrijevica', 'Municipality',NULL),
('ME-02', 'ME', '02', 'Bar', 'Municipality',NULL),
('ME-03', 'ME', '03', 'Berane', 'Municipality',NULL),
('ME-04', 'ME', '04', 'Bijelo Polje', 'Municipality',NULL),
('ME-05', 'ME', '05', 'Budva', 'Municipality',NULL),
('ME-06', 'ME', '06', 'Cetinje', 'Municipality',NULL),
('ME-07', 'ME', '07', 'Danilovgrad', 'Municipality',NULL),
('ME-08', 'ME', '08', 'Herceg-Novi', 'Municipality',NULL),
('ME-09', 'ME', '09', 'Kolašin', 'Municipality',NULL),
('ME-10', 'ME', '10', 'Kotor', 'Municipality',NULL),
('ME-11', 'ME', '11', 'Mojkovac', 'Municipality',NULL),
('ME-12', 'ME', '12', 'Nikšić', 'Municipality',NULL),
('ME-13', 'ME', '13', 'Plav', 'Municipality',NULL),
('ME-14', 'ME', '14', 'Pljevlja', 'Municipality',NULL),
('ME-15', 'ME', '15', 'Plužine', 'Municipality',NULL),
('ME-16', 'ME', '16', 'Podgorica', 'Municipality',NULL),
('ME-17', 'ME', '17', 'Rožaje', 'Municipality',NULL),
('ME-18', 'ME', '18', 'Šavnik', 'Municipality',NULL),
('ME-19', 'ME', '19', 'Tivat', 'Municipality',NULL),
('ME-20', 'ME', '20', 'Ulcinj', 'Municipality',NULL),
('ME-21', 'ME', '21', 'Žabljak', 'Municipality',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('MS', 'MSR', 'Montserrat', '', '');

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('MA', 'MAR', 'Morocco', '', 'Kingdom of Morocco');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('MA-09', 'MA', '09', 'Chaouia-Ouardigha', 'Economic region',NULL),
('MA-10', 'MA', '10', 'Doukhala-Abda', 'Economic region',NULL),
('MA-05', 'MA', '05', 'Fès-Boulemane', 'Economic region',NULL),
('MA-02', 'MA', '02', 'Gharb-Chrarda-Beni Hssen', 'Economic region',NULL),
('MA-08', 'MA', '08', 'Grand Casablanca', 'Economic region',NULL),
('MA-14', 'MA', '14', 'Guelmim-Es Smara', 'Economic region',NULL),
('MA-15', 'MA', '15', 'Laâyoune-Boujdour-Sakia el Hamra', 'Economic region',NULL),
('MA-04', 'MA', '04', 'L''Oriental', 'Economic region',NULL),
('MA-11', 'MA', '11', 'Marrakech-Tensift-Al Haouz', 'Economic region',NULL),
('MA-06', 'MA', '06', 'Meknès-Tafilalet', 'Economic region',NULL),
('MA-16', 'MA', '16', 'Oued ed Dahab-Lagouira', 'Economic region',NULL),
('MA-07', 'MA', '07', 'Rabat-Salé-Zemmour-Zaer', 'Economic region',NULL),
('MA-13', 'MA', '13', 'Sous-Massa-Draa', 'Economic region',NULL),
('MA-12', 'MA', '12', 'Tadla-Azilal', 'Economic region',NULL),
('MA-01', 'MA', '01', 'Tanger-Tétouan', 'Economic region',NULL),
('MA-03', 'MA', '03', 'Taza-Al Hoceima-Taounate', 'Economic region',NULL),
('MA-HAO', 'MA', 'HAO', 'Al Haouz', 'Province','MA-11'),
('MA-HOC', 'MA', 'HOC', 'Al Hoceïma', 'Province','MA-03'),
('MA-ASZ', 'MA', 'ASZ', 'Assa-Zag', 'Province','MA-14'),
('MA-AZI', 'MA', 'AZI', 'Azilal', 'Province','MA-12'),
('MA-BEM', 'MA', 'BEM', 'Beni Mellal', 'Province','MA-12'),
('MA-BES', 'MA', 'BES', 'Ben Slimane', 'Province','MA-09'),
('MA-BER', 'MA', 'BER', 'Berkane', 'Province','MA-04'),
('MA-BOD', 'MA', 'BOD', 'Boujdour (EH)', 'Province','MA-15'),
('MA-BOM', 'MA', 'BOM', 'Boulemane', 'Province','MA-05'),
('MA-CHE', 'MA', 'CHE', 'Chefchaouen', 'Province','MA-01'),
('MA-CHI', 'MA', 'CHI', 'Chichaoua', 'Province','MA-11'),
('MA-CHT', 'MA', 'CHT', 'Chtouka-Ait Baha', 'Province','MA-13'),
('MA-HAJ', 'MA', 'HAJ', 'El Hajeb', 'Province','MA-06'),
('MA-JDI', 'MA', 'JDI', 'El Jadida', 'Province','MA-10'),
('MA-ERR', 'MA', 'ERR', 'Errachidia', 'Province','MA-06'),
('MA-ESI', 'MA', 'ESI', 'Essaouira', 'Province','MA-11'),
('MA-ESM', 'MA', 'ESM', 'Es Smara (EH)', 'Province','MA-14'),
('MA-FIG', 'MA', 'FIG', 'Figuig', 'Province','MA-04'),
('MA-GUE', 'MA', 'GUE', 'Guelmim', 'Province','MA-14'),
('MA-IFR', 'MA', 'IFR', 'Ifrane', 'Province','MA-06'),
('MA-JRA', 'MA', 'JRA', 'Jrada', 'Province','MA-04'),
('MA-KES', 'MA', 'KES', 'Kelaat es Sraghna', 'Province','MA-11'),
('MA-KEN', 'MA', 'KEN', 'Kénitra', 'Province','MA-02'),
('MA-KHE', 'MA', 'KHE', 'Khemisaet', 'Province','MA-07'),
('MA-KHN', 'MA', 'KHN', 'Khenifra', 'Province','MA-06'),
('MA-KHO', 'MA', 'KHO', 'Khouribga', 'Province','MA-09'),
('MA-LAA', 'MA', 'LAA', 'Laâyoune (EH)', 'Province','MA-15'),
('MA-LAR', 'MA', 'LAR', 'Larache', 'Province','MA-01'),
('MA-MED', 'MA', 'MED', 'Médiouna', 'Province','MA-08'),
('MA-MOU', 'MA', 'MOU', 'Moulay Yacoub', 'Province','MA-05'),
('MA-NAD', 'MA', 'NAD', 'Nador', 'Province','MA-04'),
('MA-NOU', 'MA', 'NOU', 'Nouaceur', 'Province','MA-08'),
('MA-OUA', 'MA', 'OUA', 'Ouarzazate', 'Province','MA-13'),
('MA-OUD', 'MA', 'OUD', 'Oued ed Dahab (EH)', 'Province','MA-16'),
('MA-SAF', 'MA', 'SAF', 'Safi', 'Province','MA-10'),
('MA-SEF', 'MA', 'SEF', 'Sefrou', 'Province','MA-05'),
('MA-SET', 'MA', 'SET', 'Settat', 'Province','MA-09'),
('MA-SIK', 'MA', 'SIK', 'Sidl Kacem', 'Province','MA-02'),
('MA-TNT', 'MA', 'TNT', 'Tan-Tan', 'Province','MA-14'),
('MA-TAO', 'MA', 'TAO', 'Taounate', 'Province','MA-03'),
('MA-TAI', 'MA', 'TAI', 'Taourirt', 'Province','MA-04'),
('MA-TAR', 'MA', 'TAR', 'Taroudant', 'Province','MA-13'),
('MA-TAT', 'MA', 'TAT', 'Tata', 'Province','MA-14'),
('MA-TAZ', 'MA', 'TAZ', 'Taza', 'Province','MA-03'),
('MA-TIZ', 'MA', 'TIZ', 'Tiznit', 'Province','MA-13'),
('MA-ZAG', 'MA', 'ZAG', 'Zagora', 'Province','MA-13'),
('MA-AGD', 'MA', 'AGD', 'Agadir-Ida-Outanane', 'Prefecture','MA-13'),
('MA-AOU', 'MA', 'AOU', 'Aousserd', 'Prefecture','MA-16'),
('MA-CAS', 'MA', 'CAS', 'Casablanca [Dar el Beïda]', 'Prefecture','MA-08'),
('MA-FAH', 'MA', 'FAH', 'Fahs-Beni Makada', 'Prefecture','MA-01'),
('MA-FES', 'MA', 'FES', 'Fès-Dar-Dbibegh', 'Prefecture','MA-05'),
('MA-INE', 'MA', 'INE', 'Inezgane-Ait Melloul', 'Prefecture','MA-13'),
('MA-MMD', 'MA', 'MMD', 'Marrakech-Medina', 'Prefecture','MA-11'),
('MA-MMN', 'MA', 'MMN', 'Marrakech-Menara', 'Prefecture','MA-11'),
('MA-MEK', 'MA', 'MEK', 'Meknès', 'Prefecture','MA-06'),
('MA-MOH', 'MA', 'MOH', 'Mohammadia', 'Prefecture','MA-08'),
('MA-OUJ', 'MA', 'OUJ', 'Oujda-Angad', 'Prefecture','MA-04'),
('MA-RAB', 'MA', 'RAB', 'Rabat', 'Prefecture','MA-07'),
('MA-SAL', 'MA', 'SAL', 'Salé', 'Prefecture','MA-07'),
('MA-SYB', 'MA', 'SYB', 'Sidi Youssef Ben Ali', 'Prefecture','MA-11'),
('MA-SKH', 'MA', 'SKH', 'Skhirate-Témara', 'Prefecture','MA-07'),
('MA-TNG', 'MA', 'TNG', 'Tanger-Assilah', 'Prefecture','MA-01'),
('MA-TET', 'MA', 'TET', 'Tétouan', 'Prefecture','MA-01');

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('MZ', 'MOZ', 'Mozambique', '', 'Republic of Mozambique');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('MZ-MPM', 'MZ', 'MPM', 'Maputo (city)', 'City',NULL),
('MZ-P', 'MZ', 'P', 'Cabo Delgado', 'Province',NULL),
('MZ-G', 'MZ', 'G', 'Gaza', 'Province',NULL),
('MZ-I', 'MZ', 'I', 'Inhambane', 'Province',NULL),
('MZ-B', 'MZ', 'B', 'Manica', 'Province',NULL),
('MZ-L', 'MZ', 'L', 'Maputo', 'Province',NULL),
('MZ-N', 'MZ', 'N', 'Numpula', 'Province',NULL),
('MZ-A', 'MZ', 'A', 'Niassa', 'Province',NULL),
('MZ-S', 'MZ', 'S', 'Sofala', 'Province',NULL),
('MZ-T', 'MZ', 'T', 'Tete', 'Province',NULL),
('MZ-Q', 'MZ', 'Q', 'Zambezia', 'Province',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('MM', 'MMR', 'Myanmar', '', 'Republic of Myanmar');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('MM-07', 'MM', '07', 'Ayeyarwady', 'Division',NULL),
('MM-02', 'MM', '02', 'Bago', 'Division',NULL),
('MM-03', 'MM', '03', 'Magway', 'Division',NULL),
('MM-04', 'MM', '04', 'Mandalay', 'Division',NULL),
('MM-01', 'MM', '01', 'Sagaing', 'Division',NULL),
('MM-05', 'MM', '05', 'Tanintharyi', 'Division',NULL),
('MM-06', 'MM', '06', 'Yangon', 'Division',NULL),
('MM-14', 'MM', '14', 'Chin', 'State',NULL),
('MM-11', 'MM', '11', 'Kachin', 'State',NULL),
('MM-12', 'MM', '12', 'Kayah', 'State',NULL),
('MM-13', 'MM', '13', 'Kayin', 'State',NULL),
('MM-15', 'MM', '15', 'Mon', 'State',NULL),
('MM-16', 'MM', '16', 'Rakhine', 'State',NULL),
('MM-17', 'MM', '17', 'Shan', 'State',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('NA', 'NAM', 'Namibia', '', 'Republic of Namibia');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('NA-CA', 'NA', 'CA', 'Caprivi', 'Region',NULL),
('NA-ER', 'NA', 'ER', 'Erongo', 'Region',NULL),
('NA-HA', 'NA', 'HA', 'Hardap', 'Region',NULL),
('NA-KA', 'NA', 'KA', 'Karas', 'Region',NULL),
('NA-KH', 'NA', 'KH', 'Khomas', 'Region',NULL),
('NA-KU', 'NA', 'KU', 'Kunene', 'Region',NULL),
('NA-OW', 'NA', 'OW', 'Ohangwena', 'Region',NULL),
('NA-OK', 'NA', 'OK', 'Okavango', 'Region',NULL),
('NA-OH', 'NA', 'OH', 'Omaheke', 'Region',NULL),
('NA-OS', 'NA', 'OS', 'Omusati', 'Region',NULL),
('NA-ON', 'NA', 'ON', 'Oshana', 'Region',NULL),
('NA-OT', 'NA', 'OT', 'Oshikoto', 'Region',NULL),
('NA-OD', 'NA', 'OD', 'Otjozondjupa', 'Region',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('NR', 'NRU', 'Nauru', '', 'Republic of Nauru');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('NR-01', 'NR', '01', 'Aiwo', 'District',NULL),
('NR-02', 'NR', '02', 'Anabar', 'District',NULL),
('NR-03', 'NR', '03', 'Anetan', 'District',NULL),
('NR-04', 'NR', '04', 'Anibare', 'District',NULL),
('NR-05', 'NR', '05', 'Baiti', 'District',NULL),
('NR-06', 'NR', '06', 'Boe', 'District',NULL),
('NR-07', 'NR', '07', 'Buada', 'District',NULL),
('NR-08', 'NR', '08', 'Denigomodu', 'District',NULL),
('NR-09', 'NR', '09', 'Ewa', 'District',NULL),
('NR-10', 'NR', '10', 'Ijuw', 'District',NULL),
('NR-11', 'NR', '11', 'Meneng', 'District',NULL),
('NR-12', 'NR', '12', 'Nibok', 'District',NULL),
('NR-13', 'NR', '13', 'Uaboe', 'District',NULL),
('NR-14', 'NR', '14', 'Yaren', 'District',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('NP', 'NPL', 'Nepal', '', 'Federal Democratic Republic of Nepal');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('NP-1', 'NP', '1', 'Madhyamanchal', 'Development region',NULL),
('NP-2', 'NP', '2', 'Madhya Pashchimanchal', 'Development region',NULL),
('NP-3', 'NP', '3', 'Pashchimanchal', 'Development region',NULL),
('NP-4', 'NP', '4', 'Purwanchal', 'Development region',NULL),
('NP-5', 'NP', '5', 'Sudur Pashchimanchal', 'Development region',NULL),
('NP-BA', 'NP', 'BA', 'Bagmati', 'zone','NP-1'),
('NP-BH', 'NP', 'BH', 'Bheri', 'zone','NP-2'),
('NP-DH', 'NP', 'DH', 'Dhawalagiri', 'zone','NP-3'),
('NP-GA', 'NP', 'GA', 'Gandaki', 'zone','NP-3'),
('NP-JA', 'NP', 'JA', 'Janakpur', 'zone','NP-1'),
('NP-KA', 'NP', 'KA', 'Karnali', 'zone','NP-2'),
('NP-KO', 'NP', 'KO', 'Kosi', 'zone','NP-4'),
('NP-LU', 'NP', 'LU', 'Lumbini', 'zone','NP-3'),
('NP-MA', 'NP', 'MA', 'Mahakali', 'zone','NP-5'),
('NP-ME', 'NP', 'ME', 'Mechi', 'zone','NP-4'),
('NP-NA', 'NP', 'NA', 'Narayani', 'zone','NP-1'),
('NP-RA', 'NP', 'RA', 'Rapti', 'zone','NP-2'),
('NP-SA', 'NP', 'SA', 'Sagarmatha', 'zone','NP-4'),
('NP-SE', 'NP', 'SE', 'Seti', 'zone','NP-5');

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('NL', 'NLD', 'Netherlands', '', 'Kingdom of the Netherlands');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('NL-DR', 'NL', 'DR', 'Drenthe', 'Province',NULL),
('NL-FL', 'NL', 'FL', 'Flevoland', 'Province',NULL),
('NL-FR', 'NL', 'FR', 'Friesland', 'Province',NULL),
('NL-GE', 'NL', 'GE', 'Gelderland', 'Province',NULL),
('NL-GR', 'NL', 'GR', 'Groningen', 'Province',NULL),
('NL-LI', 'NL', 'LI', 'Limburg', 'Province',NULL),
('NL-NB', 'NL', 'NB', 'Noord-Brabant', 'Province',NULL),
('NL-NH', 'NL', 'NH', 'Noord-Holland', 'Province',NULL),
('NL-OV', 'NL', 'OV', 'Overijssel', 'Province',NULL),
('NL-UT', 'NL', 'UT', 'Utrecht', 'Province',NULL),
('NL-ZE', 'NL', 'ZE', 'Zeeland', 'Province',NULL),
('NL-ZH', 'NL', 'ZH', 'Zuid-Holland', 'Province',NULL),
('NL-AW', 'NL', 'AW', 'Aruba', 'Country',NULL),
('NL-CW', 'NL', 'CW', 'Curaçao', 'Country',NULL),
('NL-SX', 'NL', 'SX', 'Sint Maarten', 'Country',NULL),
('NL-BQ1', 'NL', 'BQ1', 'Bonaire', 'Special municipality',NULL),
('NL-BQ2', 'NL', 'BQ2', 'Saba', 'Special municipality',NULL),
('NL-BQ3', 'NL', 'BQ3', 'Sint Eustatius', 'Special municipality',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('NC', 'NCL', 'New Caledonia', '', '');

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('NZ', 'NZL', 'New Zealand', '', '');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('NZ-N', 'NZ', 'N', 'North Island', 'Island',NULL),
('NZ-S', 'NZ', 'S', 'South Island', 'Island',NULL),
('NZ-AUK', 'NZ', 'AUK', 'Auckland', 'Regional council','NZ-N'),
('NZ-BOP', 'NZ', 'BOP', 'Bay of Plenty', 'Regional council','NZ-N'),
('NZ-CAN', 'NZ', 'CAN', 'Canterbury', 'Regional council','NZ-S'),
('NZ-HKB', 'NZ', 'HKB', 'Hawke''s Bay', 'Regional council','NZ-N'),
('NZ-MWT', 'NZ', 'MWT', 'Manawatu-Wanganui', 'Regional council','NZ-N'),
('NZ-NTL', 'NZ', 'NTL', 'Northland', 'Regional council','NZ-N'),
('NZ-OTA', 'NZ', 'OTA', 'Otago', 'Regional council','NZ-S'),
('NZ-STL', 'NZ', 'STL', 'Southland', 'Regional council','NZ-S'),
('NZ-TKI', 'NZ', 'TKI', 'Taranaki', 'Regional council','NZ-N'),
('NZ-WKO', 'NZ', 'WKO', 'Waikato', 'Regional council','NZ-N'),
('NZ-WGN', 'NZ', 'WGN', 'Wellington', 'Regional council','NZ-N'),
('NZ-WTC', 'NZ', 'WTC', 'West Coast', 'Regional council','NZ-S'),
('NZ-GIS', 'NZ', 'GIS', 'Gisborne District', 'Unitary authority','NZ-N'),
('NZ-MBH', 'NZ', 'MBH', 'Marlborough District', 'Unitary authority','NZ-S'),
('NZ-NSN', 'NZ', 'NSN', 'Nelson City', 'Unitary authority','NZ-S'),
('NZ-TAS', 'NZ', 'TAS', 'Tasman District', 'Unitary authority','NZ-S'),
('NZ-CIT', 'NZ', 'CIT', 'Chatham Islands Territory', 'Special island authority',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('NI', 'NIC', 'Nicaragua', '', 'Republic of Nicaragua');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('NI-BO', 'NI', 'BO', 'Boaco', 'Department',NULL),
('NI-CA', 'NI', 'CA', 'Carazo', 'Department',NULL),
('NI-CI', 'NI', 'CI', 'Chinandega', 'Department',NULL),
('NI-CO', 'NI', 'CO', 'Chontales', 'Department',NULL),
('NI-ES', 'NI', 'ES', 'Estelí', 'Department',NULL),
('NI-GR', 'NI', 'GR', 'Granada', 'Department',NULL),
('NI-JI', 'NI', 'JI', 'Jinotega', 'Department',NULL),
('NI-LE', 'NI', 'LE', 'León', 'Department',NULL),
('NI-MD', 'NI', 'MD', 'Madriz', 'Department',NULL),
('NI-MN', 'NI', 'MN', 'Managua', 'Department',NULL),
('NI-MS', 'NI', 'MS', 'Masaya', 'Department',NULL),
('NI-MT', 'NI', 'MT', 'Matagalpa', 'Department',NULL),
('NI-NS', 'NI', 'NS', 'Nueva Segovia', 'Department',NULL),
('NI-SJ', 'NI', 'SJ', 'Río San Juan', 'Department',NULL),
('NI-RI', 'NI', 'RI', 'Rivas', 'Department',NULL),
('NI-AN', 'NI', 'AN', 'Atlántico Norte', 'Autonomous Region',NULL),
('NI-AS', 'NI', 'AS', 'Atlántico Sur', 'Autonomous Region',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('NE', 'NER', 'Niger', '', 'Republic of the Niger');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('NE-8', 'NE', '8', 'Niamey', 'Capital District',NULL),
('NE-1', 'NE', '1', 'Agadez', 'Department',NULL),
('NE-2', 'NE', '2', 'Diffa', 'Department',NULL),
('NE-3', 'NE', '3', 'Dosso', 'Department',NULL),
('NE-4', 'NE', '4', 'Maradi', 'Department',NULL),
('NE-5', 'NE', '5', 'Tahoua', 'Department',NULL),
('NE-6', 'NE', '6', 'Tillabéri', 'Department',NULL),
('NE-7', 'NE', '7', 'Zinder', 'Department',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('NG', 'NGA', 'Nigeria', '', 'Federal Republic of Nigeria');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('NG-FC', 'NG', 'FC', 'Abuja Capital Territory', 'Capital Territory',NULL),
('NG-AB', 'NG', 'AB', 'Abia', 'State',NULL),
('NG-AD', 'NG', 'AD', 'Adamawa', 'State',NULL),
('NG-AK', 'NG', 'AK', 'Akwa Ibom', 'State',NULL),
('NG-AN', 'NG', 'AN', 'Anambra', 'State',NULL),
('NG-BA', 'NG', 'BA', 'Bauchi', 'State',NULL),
('NG-BY', 'NG', 'BY', 'Bayelsa', 'State',NULL),
('NG-BE', 'NG', 'BE', 'Benue', 'State',NULL),
('NG-BO', 'NG', 'BO', 'Borno', 'State',NULL),
('NG-CR', 'NG', 'CR', 'Cross River', 'State',NULL),
('NG-DE', 'NG', 'DE', 'Delta', 'State',NULL),
('NG-EB', 'NG', 'EB', 'Ebonyi', 'State',NULL),
('NG-ED', 'NG', 'ED', 'Edo', 'State',NULL),
('NG-EK', 'NG', 'EK', 'Ekiti', 'State',NULL),
('NG-EN', 'NG', 'EN', 'Enugu', 'State',NULL),
('NG-GO', 'NG', 'GO', 'Gombe', 'State',NULL),
('NG-IM', 'NG', 'IM', 'Imo', 'State',NULL),
('NG-JI', 'NG', 'JI', 'Jigawa', 'State',NULL),
('NG-KD', 'NG', 'KD', 'Kaduna', 'State',NULL),
('NG-KN', 'NG', 'KN', 'Kano', 'State',NULL),
('NG-KT', 'NG', 'KT', 'Katsina', 'State',NULL),
('NG-KE', 'NG', 'KE', 'Kebbi', 'State',NULL),
('NG-KO', 'NG', 'KO', 'Kogi', 'State',NULL),
('NG-KW', 'NG', 'KW', 'Kwara', 'State',NULL),
('NG-LA', 'NG', 'LA', 'Lagos', 'State',NULL),
('NG-NA', 'NG', 'NA', 'Nassarawa', 'State',NULL),
('NG-NI', 'NG', 'NI', 'Niger', 'State',NULL),
('NG-OG', 'NG', 'OG', 'Ogun', 'State',NULL),
('NG-ON', 'NG', 'ON', 'Ondo', 'State',NULL),
('NG-OS', 'NG', 'OS', 'Osun', 'State',NULL),
('NG-OY', 'NG', 'OY', 'Oyo', 'State',NULL),
('NG-PL', 'NG', 'PL', 'Plateau', 'State',NULL),
('NG-RI', 'NG', 'RI', 'Rivers', 'State',NULL),
('NG-SO', 'NG', 'SO', 'Sokoto', 'State',NULL),
('NG-TA', 'NG', 'TA', 'Taraba', 'State',NULL),
('NG-YO', 'NG', 'YO', 'Yobe', 'State',NULL),
('NG-ZA', 'NG', 'ZA', 'Zamfara', 'State',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('NU', 'NIU', 'Niue', '', 'Niue');

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('NF', 'NFK', 'Norfolk Island', '', '');

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('MP', 'MNP', 'Northern Mariana Islands', '', 'Commonwealth of the Northern Mariana Islands');

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('NO', 'NOR', 'Norway', '', 'Kingdom of Norway');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('NO-02', 'NO', '02', 'Akershus', 'County',NULL),
('NO-09', 'NO', '09', 'Aust-Agder', 'County',NULL),
('NO-06', 'NO', '06', 'Buskerud', 'County',NULL),
('NO-20', 'NO', '20', 'Finnmark', 'County',NULL),
('NO-04', 'NO', '04', 'Hedmark', 'County',NULL),
('NO-12', 'NO', '12', 'Hordaland', 'County',NULL),
('NO-15', 'NO', '15', 'Møre og Romsdal', 'County',NULL),
('NO-18', 'NO', '18', 'Nordland', 'County',NULL),
('NO-17', 'NO', '17', 'Nord-Trøndelag', 'County',NULL),
('NO-05', 'NO', '05', 'Oppland', 'County',NULL),
('NO-03', 'NO', '03', 'Oslo', 'County',NULL),
('NO-11', 'NO', '11', 'Rogaland', 'County',NULL),
('NO-14', 'NO', '14', 'Sogn og Fjordane', 'County',NULL),
('NO-16', 'NO', '16', 'Sør-Trøndelag', 'County',NULL),
('NO-08', 'NO', '08', 'Telemark', 'County',NULL),
('NO-19', 'NO', '19', 'Troms', 'County',NULL),
('NO-10', 'NO', '10', 'Vest-Agder', 'County',NULL),
('NO-07', 'NO', '07', 'Vestfold', 'County',NULL),
('NO-01', 'NO', '01', 'Østfold', 'County',NULL),
('NO-22', 'NO', '22', 'Jan Mayen (Arctic Region)', 'Arctic Region',NULL),
('NO-21', 'NO', '21', 'Svalbard (Arctic Region)', 'Arctic Region',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('OM', 'OMN', 'Oman', '', 'Sultanate of Oman');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('OM-DA', 'OM', 'DA', 'Ad Dākhilīya', 'Region',NULL),
('OM-BA', 'OM', 'BA', 'Al Bāţinah', 'Region',NULL),
('OM-WU', 'OM', 'WU', 'Al Wusţá', 'Region',NULL),
('OM-SH', 'OM', 'SH', 'Ash Sharqīyah', 'Region',NULL),
('OM-ZA', 'OM', 'ZA', 'Az̧ Z̧āhirah', 'Region',NULL),
('OM-BU', 'OM', 'BU', 'Al Buraymī', 'Governorate',NULL),
('OM-MA', 'OM', 'MA', 'Masqaţ', 'Governorate',NULL),
('OM-MU', 'OM', 'MU', 'Musandam', 'Governorate',NULL),
('OM-ZU', 'OM', 'ZU', 'Z̧ufār', 'Governorate',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('PK', 'PAK', 'Pakistan', '', 'Islamic Republic of Pakistan');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('PK-IS', 'PK', 'IS', 'Islamabad', 'Capital territory',NULL),
('PK-BA', 'PK', 'BA', 'Balochistan', 'Province',NULL),
('PK-KP', 'PK', 'KP', 'Khyber Pakhtunkhwa', 'Province',NULL),
('PK-PB', 'PK', 'PB', 'Punjab', 'Province',NULL),
('PK-SD', 'PK', 'SD', 'Sindh', 'Province',NULL),
('PK-TA', 'PK', 'TA', 'Federally Administered Tribal Areas', 'Territory',NULL),
('PK-JK', 'PK', 'JK', 'Azad Kashmir', 'Area',NULL),
('PK-GB', 'PK', 'GB', 'Gilgit-Baltistan', 'Area',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('PW', 'PLW', 'Palau', '', 'Republic of Palau');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('PW-002', 'PW', '002', 'Aimeliik', 'State',NULL),
('PW-004', 'PW', '004', 'Airai', 'State',NULL),
('PW-010', 'PW', '010', 'Angaur', 'State',NULL),
('PW-050', 'PW', '050', 'Hatobohei', 'State',NULL),
('PW-100', 'PW', '100', 'Kayangel', 'State',NULL),
('PW-150', 'PW', '150', 'Koror', 'State',NULL),
('PW-212', 'PW', '212', 'Melekeok', 'State',NULL),
('PW-214', 'PW', '214', 'Ngaraard', 'State',NULL),
('PW-218', 'PW', '218', 'Ngarchelong', 'State',NULL),
('PW-222', 'PW', '222', 'Ngardmau', 'State',NULL),
('PW-224', 'PW', '224', 'Ngatpang', 'State',NULL),
('PW-226', 'PW', '226', 'Ngchesar', 'State',NULL),
('PW-227', 'PW', '227', 'Ngeremlengui', 'State',NULL),
('PW-228', 'PW', '228', 'Ngiwal', 'State',NULL),
('PW-350', 'PW', '350', 'Peleliu', 'State',NULL),
('PW-370', 'PW', '370', 'Sonsorol', 'State',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('PS', 'PSE', 'Palestine, State of', '', 'the State of Palestine');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('PS-BTH', 'PS', 'BTH', 'Bethlehem', 'Governorate',NULL),
('PS-DEB', 'PS', 'DEB', 'Deir El Balah', 'Governorate',NULL),
('PS-GZA', 'PS', 'GZA', 'Gaza', 'Governorate',NULL),
('PS-HBN', 'PS', 'HBN', 'Hebron', 'Governorate',NULL),
('PS-JEN', 'PS', 'JEN', 'Jenin', 'Governorate',NULL),
('PS-JRH', 'PS', 'JRH', 'Jericho - Al Aghwar', 'Governorate',NULL),
('PS-JEM', 'PS', 'JEM', 'Jerusalem', 'Governorate',NULL),
('PS-KYS', 'PS', 'KYS', 'Khan Yunis', 'Governorate',NULL),
('PS-NBS', 'PS', 'NBS', 'Nablus', 'Governorate',NULL),
('PS-NGZ', 'PS', 'NGZ', 'North Gaza', 'Governorate',NULL),
('PS-QQA', 'PS', 'QQA', 'Qalqilya', 'Governorate',NULL),
('PS-RFH', 'PS', 'RFH', 'Rafah', 'Governorate',NULL),
('PS-RBH', 'PS', 'RBH', 'Ramallah', 'Governorate',NULL),
('PS-SLT', 'PS', 'SLT', 'Salfit', 'Governorate',NULL),
('PS-TBS', 'PS', 'TBS', 'Tubas', 'Governorate',NULL),
('PS-TKM', 'PS', 'TKM', 'Tulkarm', 'Governorate',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('PA', 'PAN', 'Panama', '', 'Republic of Panama');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('PA-1', 'PA', '1', 'Bocas del Toro', 'Province',NULL),
('PA-4', 'PA', '4', 'Chiriquí', 'Province',NULL),
('PA-2', 'PA', '2', 'Coclé', 'Province',NULL),
('PA-3', 'PA', '3', 'Colón', 'Province',NULL),
('PA-5', 'PA', '5', 'Darién', 'Province',NULL),
('PA-6', 'PA', '6', 'Herrera', 'Province',NULL),
('PA-7', 'PA', '7', 'Los Santos', 'Province',NULL),
('PA-8', 'PA', '8', 'Panamá', 'Province',NULL),
('PA-9', 'PA', '9', 'Veraguas', 'Province',NULL),
('PA-EM', 'PA', 'EM', 'Emberá', 'Indigenous region',NULL),
('PA-KY', 'PA', 'KY', 'Kuna Yala', 'Indigenous region',NULL),
('PA-NB', 'PA', 'NB', 'Ngöbe-Buglé', 'Indigenous region',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('PG', 'PNG', 'Papua New Guinea', '', 'Independent State of Papua New Guinea');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('PG-NCD', 'PG', 'NCD', 'National Capital District (Port Moresby)', 'District',NULL),
('PG-CPM', 'PG', 'CPM', 'Central', 'Province',NULL),
('PG-CPK', 'PG', 'CPK', 'Chimbu', 'Province',NULL),
('PG-EHG', 'PG', 'EHG', 'Eastern Highlands', 'Province',NULL),
('PG-EBR', 'PG', 'EBR', 'East New Britain', 'Province',NULL),
('PG-ESW', 'PG', 'ESW', 'East Sepik', 'Province',NULL),
('PG-EPW', 'PG', 'EPW', 'Enga', 'Province',NULL),
('PG-GPK', 'PG', 'GPK', 'Gulf', 'Province',NULL),
('PG-MPM', 'PG', 'MPM', 'Madang', 'Province',NULL),
('PG-MRL', 'PG', 'MRL', 'Manus', 'Province',NULL),
('PG-MBA', 'PG', 'MBA', 'Milne Bay', 'Province',NULL),
('PG-MPL', 'PG', 'MPL', 'Morobe', 'Province',NULL),
('PG-NIK', 'PG', 'NIK', 'New Ireland', 'Province',NULL),
('PG-NPP', 'PG', 'NPP', 'Northern', 'Province',NULL),
('PG-SAN', 'PG', 'SAN', 'Sandaun', 'Province',NULL),
('PG-SHM', 'PG', 'SHM', 'Southern Highlands', 'Province',NULL),
('PG-WPD', 'PG', 'WPD', 'Western', 'Province',NULL),
('PG-WHM', 'PG', 'WHM', 'Western Highlands', 'Province',NULL),
('PG-WBK', 'PG', 'WBK', 'West New Britain', 'Province',NULL),
('PG-NSB', 'PG', 'NSB', 'Bougainville', 'Autonomous region',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('PY', 'PRY', 'Paraguay', '', 'Republic of Paraguay');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('PY-ASU', 'PY', 'ASU', 'Asunción', 'Capital district',NULL),
('PY-16', 'PY', '16', 'Alto Paraguay', 'Department',NULL),
('PY-10', 'PY', '10', 'Alto Paraná', 'Department',NULL),
('PY-13', 'PY', '13', 'Amambay', 'Department',NULL),
('PY-19', 'PY', '19', 'Boquerón', 'Department',NULL),
('PY-5', 'PY', '5', 'Caaguazú', 'Department',NULL),
('PY-6', 'PY', '6', 'Caazapá', 'Department',NULL),
('PY-14', 'PY', '14', 'Canindeyú', 'Department',NULL),
('PY-11', 'PY', '11', 'Central', 'Department',NULL),
('PY-1', 'PY', '1', 'Concepción', 'Department',NULL),
('PY-3', 'PY', '3', 'Cordillera', 'Department',NULL),
('PY-4', 'PY', '4', 'Guairá', 'Department',NULL),
('PY-7', 'PY', '7', 'Itapúa', 'Department',NULL),
('PY-8', 'PY', '8', 'Misiones', 'Department',NULL),
('PY-12', 'PY', '12', 'Ñeembucú', 'Department',NULL),
('PY-9', 'PY', '9', 'Paraguarí', 'Department',NULL),
('PY-15', 'PY', '15', 'Presidente Hayes', 'Department',NULL),
('PY-2', 'PY', '2', 'San Pedro', 'Department',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('PE', 'PER', 'Peru', '', 'Republic of Peru');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('PE-CAL', 'PE', 'CAL', 'El Callao', 'Constitutional province',NULL),
('PE-LMA', 'PE', 'LMA', 'Municipalidad Metropolitana de Lima', 'Municipality',NULL),
('PE-AMA', 'PE', 'AMA', 'Amazonas', 'Region',NULL),
('PE-ANC', 'PE', 'ANC', 'Ancash', 'Region',NULL),
('PE-APU', 'PE', 'APU', 'Apurímac', 'Region',NULL),
('PE-ARE', 'PE', 'ARE', 'Arequipa', 'Region',NULL),
('PE-AYA', 'PE', 'AYA', 'Ayacucho', 'Region',NULL),
('PE-CAJ', 'PE', 'CAJ', 'Cajamarca', 'Region',NULL),
('PE-CUS', 'PE', 'CUS', 'Cusco [Cuzco]', 'Region',NULL),
('PE-HUV', 'PE', 'HUV', 'Huancavelica', 'Region',NULL),
('PE-HUC', 'PE', 'HUC', 'Huánuco', 'Region',NULL),
('PE-ICA', 'PE', 'ICA', 'Ica', 'Region',NULL),
('PE-JUN', 'PE', 'JUN', 'Junín', 'Region',NULL),
('PE-LAL', 'PE', 'LAL', 'La Libertad', 'Region',NULL),
('PE-LAM', 'PE', 'LAM', 'Lambayeque', 'Region',NULL),
('PE-LIM', 'PE', 'LIM', 'Lima', 'Region',NULL),
('PE-LOR', 'PE', 'LOR', 'Loreto', 'Region',NULL),
('PE-MDD', 'PE', 'MDD', 'Madre de Dios', 'Region',NULL),
('PE-MOQ', 'PE', 'MOQ', 'Moquegua', 'Region',NULL),
('PE-PAS', 'PE', 'PAS', 'Pasco', 'Region',NULL),
('PE-PIU', 'PE', 'PIU', 'Piura', 'Region',NULL),
('PE-PUN', 'PE', 'PUN', 'Puno', 'Region',NULL),
('PE-SAM', 'PE', 'SAM', 'San Martín', 'Region',NULL),
('PE-TAC', 'PE', 'TAC', 'Tacna', 'Region',NULL),
('PE-TUM', 'PE', 'TUM', 'Tumbes', 'Region',NULL),
('PE-UCA', 'PE', 'UCA', 'Ucayali', 'Region',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('PH', 'PHL', 'Philippines', '', 'Republic of the Philippines');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('PH-14', 'PH', '14', 'Autonomous Region in Muslim Mindanao (ARMM)', 'Region',NULL),
('PH-05', 'PH', '05', 'Bicol (Region V)', 'Region',NULL),
('PH-02', 'PH', '02', 'Cagayan Valley (Region II)', 'Region',NULL),
('PH-40', 'PH', '40', 'CALABARZON (Region IV-A)', 'Region',NULL),
('PH-13', 'PH', '13', 'Caraga (Region XIII)', 'Region',NULL),
('PH-03', 'PH', '03', 'Central Luzon (Region III)', 'Region',NULL),
('PH-07', 'PH', '07', 'Central Visayas (Region VII)', 'Region',NULL),
('PH-15', 'PH', '15', 'Cordillera Administrative Region (CAR)', 'Region',NULL),
('PH-08', 'PH', '08', 'Eastern Visayas (Region VIII)', 'Region',NULL),
('PH-01', 'PH', '01', 'Ilocos (Region I)', 'Region',NULL),
('PH-41', 'PH', '41', 'MIMAROPA (Region IV-B)', 'Region',NULL),
('PH-00', 'PH', '00', 'National Capital Region', 'Region',NULL),
('PH-10', 'PH', '10', 'Northern Mindanao (Region X)', 'Region',NULL),
('PH-11', 'PH', '11', 'Davao (Region XI)', 'Region',NULL),
('PH-12', 'PH', '12', 'Soccsksargen (Region XII)', 'Region',NULL),
('PH-06', 'PH', '06', 'Western Visayas (Region VI)', 'Region',NULL),
('PH-09', 'PH', '09', 'Zamboanga Peninsula (Region IX)', 'Region',NULL),
('PH-ABR', 'PH', 'ABR', 'Abra', 'Province','PH-15'),
('PH-AGN', 'PH', 'AGN', 'Agusan del Norte', 'Province','PH-13'),
('PH-AGS', 'PH', 'AGS', 'Agusan del Sur', 'Province','PH-13'),
('PH-AKL', 'PH', 'AKL', 'Aklan', 'Province','PH-06'),
('PH-ALB', 'PH', 'ALB', 'Albay', 'Province','PH-05'),
('PH-ANT', 'PH', 'ANT', 'Antique', 'Province','PH-06'),
('PH-APA', 'PH', 'APA', 'Apayao', 'Province','PH-15'),
('PH-AUR', 'PH', 'AUR', 'Aurora', 'Province','PH-03'),
('PH-BAS', 'PH', 'BAS', 'Basilan', 'Province','PH-09'),
('PH-BAN', 'PH', 'BAN', 'Batasn', 'Province','PH-03'),
('PH-BTN', 'PH', 'BTN', 'Batanes', 'Province','PH-02'),
('PH-BTG', 'PH', 'BTG', 'Batangas', 'Province','PH-40'),
('PH-BEN', 'PH', 'BEN', 'Benguet', 'Province','PH-15'),
('PH-BIL', 'PH', 'BIL', 'Biliran', 'Province','PH-08'),
('PH-BOH', 'PH', 'BOH', 'Bohol', 'Province','PH-07'),
('PH-BUK', 'PH', 'BUK', 'Bukidnon', 'Province','PH-10'),
('PH-BUL', 'PH', 'BUL', 'Bulacan', 'Province','PH-03'),
('PH-CAG', 'PH', 'CAG', 'Cagayan', 'Province','PH-02'),
('PH-CAN', 'PH', 'CAN', 'Camarines Norte', 'Province','PH-05'),
('PH-CAS', 'PH', 'CAS', 'Camarines Sur', 'Province','PH-05'),
('PH-CAM', 'PH', 'CAM', 'Camiguin', 'Province','PH-10'),
('PH-CAP', 'PH', 'CAP', 'Capiz', 'Province','PH-06'),
('PH-CAT', 'PH', 'CAT', 'Catanduanes', 'Province','PH-05'),
('PH-CAV', 'PH', 'CAV', 'Cavite', 'Province','PH-40'),
('PH-CEB', 'PH', 'CEB', 'Cebu', 'Province','PH-07'),
('PH-COM', 'PH', 'COM', 'Compostela Valley', 'Province','PH-11'),
('PH-DAV', 'PH', 'DAV', 'Davao del Norte', 'Province','PH-11'),
('PH-DAS', 'PH', 'DAS', 'Davao del Sur', 'Province','PH-11'),
('PH-DAO', 'PH', 'DAO', 'Davao Oriental', 'Province','PH-11'),
('PH-DIN', 'PH', 'DIN', 'Dinagat Islands', 'Province','PH-13'),
('PH-EAS', 'PH', 'EAS', 'Eastern Samar', 'Province','PH-08'),
('PH-GUI', 'PH', 'GUI', 'Guimaras', 'Province','PH-06'),
('PH-IFU', 'PH', 'IFU', 'Ifugao', 'Province','PH-15'),
('PH-ILN', 'PH', 'ILN', 'Ilocos Norte', 'Province','PH-01'),
('PH-ILS', 'PH', 'ILS', 'Ilocos Sur', 'Province','PH-01'),
('PH-ILI', 'PH', 'ILI', 'Iloilo', 'Province','PH-06'),
('PH-ISA', 'PH', 'ISA', 'Isabela', 'Province','PH-02'),
('PH-KAL', 'PH', 'KAL', 'Kalinga-Apayso', 'Province','PH-15'),
('PH-LAG', 'PH', 'LAG', 'Laguna', 'Province','PH-40'),
('PH-LAN', 'PH', 'LAN', 'Lanao del Norte', 'Province','PH-12'),
('PH-LAS', 'PH', 'LAS', 'Lanao del Sur', 'Province','PH-14'),
('PH-LUN', 'PH', 'LUN', 'La Union', 'Province','PH-01'),
('PH-LEY', 'PH', 'LEY', 'Leyte', 'Province','PH-08'),
('PH-MAG', 'PH', 'MAG', 'Maguindanao', 'Province','PH-14'),
('PH-MAD', 'PH', 'MAD', 'Marinduque', 'Province','PH-41'),
('PH-MAS', 'PH', 'MAS', 'Masbate', 'Province','PH-05'),
('PH-MDC', 'PH', 'MDC', 'Mindoro Occidental', 'Province','PH-41'),
('PH-MDR', 'PH', 'MDR', 'Mindoro Oriental', 'Province','PH-41'),
('PH-MSC', 'PH', 'MSC', 'Misamis Occidental', 'Province','PH-10'),
('PH-MSR', 'PH', 'MSR', 'Misamis Oriental', 'Province','PH-10'),
('PH-MOU', 'PH', 'MOU', 'Mountain Province', 'Province','PH-15'),
('PH-NEC', 'PH', 'NEC', 'Negroe Occidental', 'Province','PH-06'),
('PH-NER', 'PH', 'NER', 'Negros Oriental', 'Province','PH-07'),
('PH-NCO', 'PH', 'NCO', 'North Cotabato', 'Province','PH-12'),
('PH-NSA', 'PH', 'NSA', 'Northern Samar', 'Province','PH-08'),
('PH-NUE', 'PH', 'NUE', 'Nueva Ecija', 'Province','PH-03'),
('PH-NUV', 'PH', 'NUV', 'Nueva Vizcaya', 'Province','PH-02'),
('PH-PLW', 'PH', 'PLW', 'Palawan', 'Province','PH-41'),
('PH-PAM', 'PH', 'PAM', 'Pampanga', 'Province','PH-03'),
('PH-PAN', 'PH', 'PAN', 'Pangasinan', 'Province','PH-01'),
('PH-QUE', 'PH', 'QUE', 'Quezon', 'Province','PH-40'),
('PH-QUI', 'PH', 'QUI', 'Quirino', 'Province','PH-02'),
('PH-RIZ', 'PH', 'RIZ', 'Rizal', 'Province','PH-40'),
('PH-ROM', 'PH', 'ROM', 'Romblon', 'Province','PH-41'),
('PH-SAR', 'PH', 'SAR', 'Sarangani', 'Province','PH-11'),
('PH-SIG', 'PH', 'SIG', 'Siquijor', 'Province','PH-07'),
('PH-SOR', 'PH', 'SOR', 'Sorsogon', 'Province','PH-05'),
('PH-SCO', 'PH', 'SCO', 'South Cotabato', 'Province','PH-11'),
('PH-SLE', 'PH', 'SLE', 'Southern Leyte', 'Province','PH-08'),
('PH-SUK', 'PH', 'SUK', 'Sultan Kudarat', 'Province','PH-12'),
('PH-SLU', 'PH', 'SLU', 'Sulu', 'Province','PH-14'),
('PH-SUN', 'PH', 'SUN', 'Surigao del Norte', 'Province','PH-13'),
('PH-SUR', 'PH', 'SUR', 'Surigao del Sur', 'Province','PH-13'),
('PH-TAR', 'PH', 'TAR', 'Tarlac', 'Province','PH-03'),
('PH-TAW', 'PH', 'TAW', 'Tawi-Tawi', 'Province','PH-14'),
('PH-WSA', 'PH', 'WSA', 'Western Samar', 'Province','PH-08'),
('PH-ZMB', 'PH', 'ZMB', 'Zambales', 'Province','PH-03'),
('PH-ZAN', 'PH', 'ZAN', 'Zamboanga del Norte', 'Province','PH-09'),
('PH-ZAS', 'PH', 'ZAS', 'Zamboanga del Sur', 'Province','PH-09'),
('PH-ZSI', 'PH', 'ZSI', 'Zamboanga Sibugay', 'Province','PH-09');

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('PN', 'PCN', 'Pitcairn', '', '');

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('PL', 'POL', 'Poland', '', 'Republic of Poland');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('PL-DS', 'PL', 'DS', 'Dolnośląskie', 'Province',NULL),
('PL-KP', 'PL', 'KP', 'Kujawsko-pomorskie', 'Province',NULL),
('PL-LU', 'PL', 'LU', 'Lubelskie', 'Province',NULL),
('PL-LB', 'PL', 'LB', 'Lubuskie', 'Province',NULL),
('PL-LD', 'PL', 'LD', 'Łódzkie', 'Province',NULL),
('PL-MA', 'PL', 'MA', 'Małopolskie', 'Province',NULL),
('PL-MZ', 'PL', 'MZ', 'Mazowieckie', 'Province',NULL),
('PL-OP', 'PL', 'OP', 'Opolskie', 'Province',NULL),
('PL-PK', 'PL', 'PK', 'Podkarpackie', 'Province',NULL),
('PL-PD', 'PL', 'PD', 'Podlaskie', 'Province',NULL),
('PL-PM', 'PL', 'PM', 'Pomorskie', 'Province',NULL),
('PL-SL', 'PL', 'SL', 'Śląskie', 'Province',NULL),
('PL-SK', 'PL', 'SK', 'Świętokrzyskie', 'Province',NULL),
('PL-WN', 'PL', 'WN', 'Warmińsko-mazurskie', 'Province',NULL),
('PL-WP', 'PL', 'WP', 'Wielkopolskie', 'Province',NULL),
('PL-ZP', 'PL', 'ZP', 'Zachodniopomorskie', 'Province',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('PT', 'PRT', 'Portugal', '', 'Portuguese Republic');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('PT-01', 'PT', '01', 'Aveiro', 'District',NULL),
('PT-02', 'PT', '02', 'Beja', 'District',NULL),
('PT-03', 'PT', '03', 'Braga', 'District',NULL),
('PT-04', 'PT', '04', 'Bragança', 'District',NULL),
('PT-05', 'PT', '05', 'Castelo Branco', 'District',NULL),
('PT-06', 'PT', '06', 'Coimbra', 'District',NULL),
('PT-07', 'PT', '07', 'Évora', 'District',NULL),
('PT-08', 'PT', '08', 'Faro', 'District',NULL),
('PT-09', 'PT', '09', 'Guarda', 'District',NULL),
('PT-10', 'PT', '10', 'Leiria', 'District',NULL),
('PT-11', 'PT', '11', 'Lisboa', 'District',NULL),
('PT-12', 'PT', '12', 'Portalegre', 'District',NULL),
('PT-13', 'PT', '13', 'Porto', 'District',NULL),
('PT-14', 'PT', '14', 'Santarém', 'District',NULL),
('PT-15', 'PT', '15', 'Setúbal', 'District',NULL),
('PT-16', 'PT', '16', 'Viana do Castelo', 'District',NULL),
('PT-17', 'PT', '17', 'Vila Real', 'District',NULL),
('PT-18', 'PT', '18', 'Viseu', 'District',NULL),
('PT-20', 'PT', '20', 'Região Autónoma dos Açores', 'Autonomous region',NULL),
('PT-30', 'PT', '30', 'Região Autónoma da Madeira', 'Autonomous region',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('PR', 'PRI', 'Puerto Rico', '', '');

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('QA', 'QAT', 'Qatar', '', 'State of Qatar');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('QA-DA', 'QA', 'DA', 'Ad Dawhah', 'Municipality',NULL),
('QA-KH', 'QA', 'KH', 'Al Khawr wa adh Dhakhīrah', 'Municipality',NULL),
('QA-WA', 'QA', 'WA', 'Al Wakrah', 'Municipality',NULL),
('QA-RA', 'QA', 'RA', 'Ar Rayyan', 'Municipality',NULL),
('QA-MS', 'QA', 'MS', 'Ash Shamal', 'Municipality',NULL),
('QA-ZA', 'QA', 'ZA', 'Az̧ Z̧a‘āyin', 'Municipality',NULL),
('QA-US', 'QA', 'US', 'Umm Salal', 'Municipality',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('RE', 'REU', 'Réunion', '', '');

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('RO', 'ROU', 'Romania', '', '');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('RO-AB', 'RO', 'AB', 'Alba', 'Department',NULL),
('RO-AR', 'RO', 'AR', 'Arad', 'Department',NULL),
('RO-AG', 'RO', 'AG', 'Argeș', 'Department',NULL),
('RO-BC', 'RO', 'BC', 'Bacău', 'Department',NULL),
('RO-BH', 'RO', 'BH', 'Bihor', 'Department',NULL),
('RO-BN', 'RO', 'BN', 'Bistrița-Năsăud', 'Department',NULL),
('RO-BT', 'RO', 'BT', 'Botoșani', 'Department',NULL),
('RO-BV', 'RO', 'BV', 'Brașov', 'Department',NULL),
('RO-BR', 'RO', 'BR', 'Brăila', 'Department',NULL),
('RO-BZ', 'RO', 'BZ', 'Buzău', 'Department',NULL),
('RO-CS', 'RO', 'CS', 'Caraș-Severin', 'Department',NULL),
('RO-CL', 'RO', 'CL', 'Călărași', 'Department',NULL),
('RO-CJ', 'RO', 'CJ', 'Cluj', 'Department',NULL),
('RO-CT', 'RO', 'CT', 'Constanța', 'Department',NULL),
('RO-CV', 'RO', 'CV', 'Covasna', 'Department',NULL),
('RO-DB', 'RO', 'DB', 'Dâmbovița', 'Department',NULL),
('RO-DJ', 'RO', 'DJ', 'Dolj', 'Department',NULL),
('RO-GL', 'RO', 'GL', 'Galați', 'Department',NULL),
('RO-GR', 'RO', 'GR', 'Giurgiu', 'Department',NULL),
('RO-GJ', 'RO', 'GJ', 'Gorj', 'Department',NULL),
('RO-HR', 'RO', 'HR', 'Harghita', 'Department',NULL),
('RO-HD', 'RO', 'HD', 'Hunedoara', 'Department',NULL),
('RO-IL', 'RO', 'IL', 'Ialomița', 'Department',NULL),
('RO-IS', 'RO', 'IS', 'Iași', 'Department',NULL),
('RO-IF', 'RO', 'IF', 'Ilfov', 'Department',NULL),
('RO-MM', 'RO', 'MM', 'Maramureș', 'Department',NULL),
('RO-MH', 'RO', 'MH', 'Mehedinți', 'Department',NULL),
('RO-MS', 'RO', 'MS', 'Mureș', 'Department',NULL),
('RO-NT', 'RO', 'NT', 'Neamț', 'Department',NULL),
('RO-OT', 'RO', 'OT', 'Olt', 'Department',NULL),
('RO-PH', 'RO', 'PH', 'Prahova', 'Department',NULL),
('RO-SM', 'RO', 'SM', 'Satu Mare', 'Department',NULL),
('RO-SJ', 'RO', 'SJ', 'Sălaj', 'Department',NULL),
('RO-SB', 'RO', 'SB', 'Sibiu', 'Department',NULL),
('RO-SV', 'RO', 'SV', 'Suceava', 'Department',NULL),
('RO-TR', 'RO', 'TR', 'Teleorman', 'Department',NULL),
('RO-TM', 'RO', 'TM', 'Timiș', 'Department',NULL),
('RO-TL', 'RO', 'TL', 'Tulcea', 'Department',NULL),
('RO-VS', 'RO', 'VS', 'Vaslui', 'Department',NULL),
('RO-VL', 'RO', 'VL', 'Vâlcea', 'Department',NULL),
('RO-VN', 'RO', 'VN', 'Vrancea', 'Department',NULL),
('RO-B', 'RO', 'B', 'București', 'Municipality',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('RU', 'RUS', 'Russian Federation', '', '');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('RU-AD', 'RU', 'AD', 'Adygeya, Respublika', 'Republic',NULL),
('RU-AL', 'RU', 'AL', 'Altay, Respublika', 'Republic',NULL),
('RU-BA', 'RU', 'BA', 'Bashkortostan, Respublika', 'Republic',NULL),
('RU-BU', 'RU', 'BU', 'Buryatiya, Respublika', 'Republic',NULL),
('RU-CE', 'RU', 'CE', 'Chechenskaya Respublika', 'Republic',NULL),
('RU-CU', 'RU', 'CU', 'Chuvashskaya Respublika', 'Republic',NULL),
('RU-DA', 'RU', 'DA', 'Dagestan, Respublika', 'Republic',NULL),
('RU-IN', 'RU', 'IN', 'Respublika Ingushetiya', 'Republic',NULL),
('RU-KB', 'RU', 'KB', 'Kabardino-Balkarskaya Respublika', 'Republic',NULL),
('RU-KL', 'RU', 'KL', 'Kalmykiya, Respublika', 'Republic',NULL),
('RU-KC', 'RU', 'KC', 'Karachayevo-Cherkesskaya Respublika', 'Republic',NULL),
('RU-KR', 'RU', 'KR', 'Kareliya, Respublika', 'Republic',NULL),
('RU-KK', 'RU', 'KK', 'Khakasiya, Respublika', 'Republic',NULL),
('RU-KO', 'RU', 'KO', 'Komi, Respublika', 'Republic',NULL),
('RU-ME', 'RU', 'ME', 'Mariy El, Respublika', 'Republic',NULL),
('RU-MO', 'RU', 'MO', 'Mordoviya, Respublika', 'Republic',NULL),
('RU-SA', 'RU', 'SA', 'Sakha, Respublika [Yakutiya]', 'Republic',NULL),
('RU-SE', 'RU', 'SE', 'Severnaya Osetiya-Alaniya, Respublika', 'Republic',NULL),
('RU-TA', 'RU', 'TA', 'Tatarstan, Respublika', 'Republic',NULL),
('RU-TY', 'RU', 'TY', 'Tyva, Respublika [Tuva]', 'Republic',NULL),
('RU-UD', 'RU', 'UD', 'Udmurtskaya Respublika', 'Republic',NULL),
('RU-ALT', 'RU', 'ALT', 'Altayskiy kray', 'Administrative Territory',NULL),
('RU-KAM', 'RU', 'KAM', 'Kamchatskiy kray', 'Administrative Territory',NULL),
('RU-KHA', 'RU', 'KHA', 'Khabarovskiy kray', 'Administrative Territory',NULL),
('RU-KDA', 'RU', 'KDA', 'Krasnodarskiy kray', 'Administrative Territory',NULL),
('RU-KYA', 'RU', 'KYA', 'Krasnoyarskiy kray', 'Administrative Territory',NULL),
('RU-PER', 'RU', 'PER', 'Permskiy kray', 'Administrative Territory',NULL),
('RU-PRI', 'RU', 'PRI', 'Primorskiy kray', 'Administrative Territory',NULL),
('RU-STA', 'RU', 'STA', 'Stavropol''skiy kray', 'Administrative Territory',NULL),
('RU-ZAB', 'RU', 'ZAB', 'Zabajkal''skij kraj', 'Administrative Territory',NULL),
('RU-AMU', 'RU', 'AMU', 'Amurskaya oblast''', 'Administrative Region',NULL),
('RU-ARK', 'RU', 'ARK', 'Arkhangel''skaya oblast''', 'Administrative Region',NULL),
('RU-AST', 'RU', 'AST', 'Astrakhanskaya oblast''', 'Administrative Region',NULL),
('RU-BEL', 'RU', 'BEL', 'Belgorodskaya oblast''', 'Administrative Region',NULL),
('RU-BRY', 'RU', 'BRY', 'Bryanskaya oblast''', 'Administrative Region',NULL),
('RU-CHE', 'RU', 'CHE', 'Chelyabinskaya oblast''', 'Administrative Region',NULL),
('RU-IRK', 'RU', 'IRK', 'Irkutiskaya oblast''', 'Administrative Region',NULL),
('RU-IVA', 'RU', 'IVA', 'Ivanovskaya oblast''', 'Administrative Region',NULL),
('RU-KGD', 'RU', 'KGD', 'Kaliningradskaya oblast''', 'Administrative Region',NULL),
('RU-KLU', 'RU', 'KLU', 'Kaluzhskaya oblast''', 'Administrative Region',NULL),
('RU-KEM', 'RU', 'KEM', 'Kemerovskaya oblast''', 'Administrative Region',NULL),
('RU-KIR', 'RU', 'KIR', 'Kirovskaya oblast''', 'Administrative Region',NULL),
('RU-KOS', 'RU', 'KOS', 'Kostromskaya oblast''', 'Administrative Region',NULL),
('RU-KGN', 'RU', 'KGN', 'Kurganskaya oblast''', 'Administrative Region',NULL),
('RU-KRS', 'RU', 'KRS', 'Kurskaya oblast''', 'Administrative Region',NULL),
('RU-LEN', 'RU', 'LEN', 'Leningradskaya oblast''', 'Administrative Region',NULL),
('RU-LIP', 'RU', 'LIP', 'Lipetskaya oblast''', 'Administrative Region',NULL),
('RU-MAG', 'RU', 'MAG', 'Magadanskaya oblast''', 'Administrative Region',NULL),
('RU-MOS', 'RU', 'MOS', 'Moskovskaya oblast''', 'Administrative Region',NULL),
('RU-MUR', 'RU', 'MUR', 'Murmanskaya oblast''', 'Administrative Region',NULL),
('RU-NIZ', 'RU', 'NIZ', 'Nizhegorodskaya oblast''', 'Administrative Region',NULL),
('RU-NGR', 'RU', 'NGR', 'Novgorodskaya oblast''', 'Administrative Region',NULL),
('RU-NVS', 'RU', 'NVS', 'Novosibirskaya oblast''', 'Administrative Region',NULL),
('RU-OMS', 'RU', 'OMS', 'Omskaya oblast''', 'Administrative Region',NULL),
('RU-ORE', 'RU', 'ORE', 'Orenburgskaya oblast''', 'Administrative Region',NULL),
('RU-ORL', 'RU', 'ORL', 'Orlovskaya oblast''', 'Administrative Region',NULL),
('RU-PNZ', 'RU', 'PNZ', 'Penzenskaya oblast''', 'Administrative Region',NULL),
('RU-PSK', 'RU', 'PSK', 'Pskovskaya oblast''', 'Administrative Region',NULL),
('RU-ROS', 'RU', 'ROS', 'Rostovskaya oblast''', 'Administrative Region',NULL),
('RU-RYA', 'RU', 'RYA', 'Ryazanskaya oblast''', 'Administrative Region',NULL),
('RU-SAK', 'RU', 'SAK', 'Sakhalinskaya oblast''', 'Administrative Region',NULL),
('RU-SAM', 'RU', 'SAM', 'Samaraskaya oblast''', 'Administrative Region',NULL),
('RU-SAR', 'RU', 'SAR', 'Saratovskaya oblast''', 'Administrative Region',NULL),
('RU-SMO', 'RU', 'SMO', 'Smolenskaya oblast''', 'Administrative Region',NULL),
('RU-SVE', 'RU', 'SVE', 'Sverdlovskaya oblast''', 'Administrative Region',NULL),
('RU-TAM', 'RU', 'TAM', 'Tambovskaya oblast''', 'Administrative Region',NULL),
('RU-TOM', 'RU', 'TOM', 'Tomskaya oblast''', 'Administrative Region',NULL),
('RU-TUL', 'RU', 'TUL', 'Tul''skaya oblast''', 'Administrative Region',NULL),
('RU-TVE', 'RU', 'TVE', 'Tverskaya oblast''', 'Administrative Region',NULL),
('RU-TYU', 'RU', 'TYU', 'Tyumenskaya oblast''', 'Administrative Region',NULL),
('RU-ULY', 'RU', 'ULY', 'Ul''yanovskaya oblast''', 'Administrative Region',NULL),
('RU-VLA', 'RU', 'VLA', 'Vladimirskaya oblast''', 'Administrative Region',NULL),
('RU-VGG', 'RU', 'VGG', 'Volgogradskaya oblast''', 'Administrative Region',NULL),
('RU-VLG', 'RU', 'VLG', 'Vologodskaya oblast''', 'Administrative Region',NULL),
('RU-VOR', 'RU', 'VOR', 'Voronezhskaya oblast''', 'Administrative Region',NULL),
('RU-YAR', 'RU', 'YAR', 'Yaroslavskaya oblast''', 'Administrative Region',NULL),
('RU-MOW', 'RU', 'MOW', 'Moskva', 'Autonomous City',NULL),
('RU-SPE', 'RU', 'SPE', 'Sankt-Peterburg', 'Autonomous City',NULL),
('RU-YEV', 'RU', 'YEV', 'Yevreyskaya avtonomnaya oblast''', 'Autonomous Region',NULL),
('RU-CHU', 'RU', 'CHU', 'Chukotskiy avtonomnyy okrug', 'Autonomous District',NULL),
('RU-KHM', 'RU', 'KHM', 'Khanty-Mansiysky avtonomnyy okrug-Yugra', 'Autonomous District',NULL),
('RU-NEN', 'RU', 'NEN', 'Nenetskiy avtonomnyy okrug', 'Autonomous District',NULL),
('RU-YAN', 'RU', 'YAN', 'Yamalo-Nenetskiy avtonomnyy okrug', 'Autonomous District',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('RW', 'RWA', 'Rwanda', '', 'Rwandese Republic');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('RW-01', 'RW', '01', 'Ville de Kigali', 'Town council',NULL),
('RW-02', 'RW', '02', 'Est', 'Province',NULL),
('RW-03', 'RW', '03', 'Nord', 'Province',NULL),
('RW-04', 'RW', '04', 'Ouest', 'Province',NULL),
('RW-05', 'RW', '05', 'Sud', 'Province',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('BL', 'BLM', 'Saint Barthélemy', '', '');

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('SH', 'SHN', 'Saint Helena, Ascension and Tristan da Cunha', '', '');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('SH-AC', 'SH', 'AC', 'Ascension', 'Geographical Entity',NULL),
('SH-HL', 'SH', 'HL', 'Saint Helena', 'Geographical Entity',NULL),
('SH-TA', 'SH', 'TA', 'Tristan da Cunha', 'Geographical Entity',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('KN', 'KNA', 'Saint Kitts and Nevis', '', '');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('KN-K', 'KN', 'K', 'Saint Kitts', 'State',NULL),
('KN-N', 'KN', 'N', 'Nevis', 'State',NULL),
('KN-01', 'KN', '01', 'Christ Church Nichola Town', 'Parish','KN-K'),
('KN-02', 'KN', '02', 'Saint Anne Sandy Point', 'Parish','KN-K'),
('KN-03', 'KN', '03', 'Saint George Basseterre', 'Parish','KN-K'),
('KN-04', 'KN', '04', 'Saint George Gingerland', 'Parish','KN-N'),
('KN-05', 'KN', '05', 'Saint James Windward', 'Parish','KN-N'),
('KN-06', 'KN', '06', 'Saint John Capisterre', 'Parish','KN-K'),
('KN-07', 'KN', '07', 'Saint John Figtree', 'Parish','KN-N'),
('KN-08', 'KN', '08', 'Saint Mary Cayon', 'Parish','KN-K'),
('KN-09', 'KN', '09', 'Saint Paul Capisterre', 'Parish','KN-K'),
('KN-10', 'KN', '10', 'Saint Paul Charlestown', 'Parish','KN-N'),
('KN-11', 'KN', '11', 'Saint Peter Basseterre', 'Parish','KN-K'),
('KN-12', 'KN', '12', 'Saint Thomas Lowland', 'Parish','KN-N'),
('KN-13', 'KN', '13', 'Saint Thomas Middle Island', 'Parish','KN-K'),
('KN-15', 'KN', '15', 'Trinity Palmetto Point', 'Parish','KN-K');

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('LC', 'LCA', 'Saint Lucia', '', '');

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('MF', 'MAF', 'Saint Martin (French part)', '', '');

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('PM', 'SPM', 'Saint Pierre and Miquelon', '', '');

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('VC', 'VCT', 'Saint Vincent and the Grenadines', '', '');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('VC-01', 'VC', '01', 'Charlotte', 'Parish',NULL),
('VC-06', 'VC', '06', 'Grenadines', 'Parish',NULL),
('VC-02', 'VC', '02', 'Saint Andrew', 'Parish',NULL),
('VC-03', 'VC', '03', 'Saint David', 'Parish',NULL),
('VC-04', 'VC', '04', 'Saint George', 'Parish',NULL),
('VC-05', 'VC', '05', 'Saint Patrick', 'Parish',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('WS', 'WSM', 'Samoa', '', 'Independent State of Samoa');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('WS-AA', 'WS', 'AA', 'A''ana', 'District',NULL),
('WS-AL', 'WS', 'AL', 'Aiga-i-le-Tai', 'District',NULL),
('WS-AT', 'WS', 'AT', 'Atua', 'District',NULL),
('WS-FA', 'WS', 'FA', 'Fa''asaleleaga', 'District',NULL),
('WS-GE', 'WS', 'GE', 'Gaga''emauga', 'District',NULL),
('WS-GI', 'WS', 'GI', 'Gagaifomauga', 'District',NULL),
('WS-PA', 'WS', 'PA', 'Palauli', 'District',NULL),
('WS-SA', 'WS', 'SA', 'Satupa''itea', 'District',NULL),
('WS-TU', 'WS', 'TU', 'Tuamasaga', 'District',NULL),
('WS-VF', 'WS', 'VF', 'Va''a-o-Fonoti', 'District',NULL),
('WS-VS', 'WS', 'VS', 'Vaisigano', 'District',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('SM', 'SMR', 'San Marino', '', 'Republic of San Marino');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('SM-01', 'SM', '01', 'Acquaviva', 'Municipalities',NULL),
('SM-06', 'SM', '06', 'Borgo Maggiore', 'Municipalities',NULL),
('SM-02', 'SM', '02', 'Chiesanuova', 'Municipalities',NULL),
('SM-03', 'SM', '03', 'Domagnano', 'Municipalities',NULL),
('SM-04', 'SM', '04', 'Faetano', 'Municipalities',NULL),
('SM-05', 'SM', '05', 'Fiorentino', 'Municipalities',NULL),
('SM-08', 'SM', '08', 'Montegiardino', 'Municipalities',NULL),
('SM-07', 'SM', '07', 'San Marino', 'Municipalities',NULL),
('SM-09', 'SM', '09', 'Serravalle', 'Municipalities',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('ST', 'STP', 'Sao Tome and Principe', '', 'Democratic Republic of Sao Tome and Principe');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('ST-P', 'ST', 'P', 'Príncipe', 'Municipality',NULL),
('ST-S', 'ST', 'S', 'São Tomé', 'Municipality',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('SA', 'SAU', 'Saudi Arabia', '', 'Kingdom of Saudi Arabia');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('SA-11', 'SA', '11', 'Al Bāhah', 'Province',NULL),
('SA-08', 'SA', '08', 'Al Ḥudūd ash Shamāliyah', 'Province',NULL),
('SA-12', 'SA', '12', 'Al Jawf', 'Province',NULL),
('SA-03', 'SA', '03', 'Al Madīnah', 'Province',NULL),
('SA-05', 'SA', '05', 'Al Qaşīm', 'Province',NULL),
('SA-01', 'SA', '01', 'Ar Riyāḍ', 'Province',NULL),
('SA-04', 'SA', '04', 'Ash Sharqīyah', 'Province',NULL),
('SA-14', 'SA', '14', '`Asīr', 'Province',NULL),
('SA-06', 'SA', '06', 'Ḥā''il', 'Province',NULL),
('SA-09', 'SA', '09', 'Jīzan', 'Province',NULL),
('SA-02', 'SA', '02', 'Makkah', 'Province',NULL),
('SA-10', 'SA', '10', 'Najrān', 'Province',NULL),
('SA-07', 'SA', '07', 'Tabūk', 'Province',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('SN', 'SEN', 'Senegal', '', 'Republic of Senegal');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('SN-DK', 'SN', 'DK', 'Dakar', 'Region',NULL),
('SN-DB', 'SN', 'DB', 'Diourbel', 'Region',NULL),
('SN-FK', 'SN', 'FK', 'Fatick', 'Region',NULL),
('SN-KA', 'SN', 'KA', 'Kaffrine', 'Region',NULL),
('SN-KL', 'SN', 'KL', 'Kaolack', 'Region',NULL),
('SN-KE', 'SN', 'KE', 'Kédougou', 'Region',NULL),
('SN-KD', 'SN', 'KD', 'Kolda', 'Region',NULL),
('SN-LG', 'SN', 'LG', 'Louga', 'Region',NULL),
('SN-MT', 'SN', 'MT', 'Matam', 'Region',NULL),
('SN-SL', 'SN', 'SL', 'Saint-Louis', 'Region',NULL),
('SN-SE', 'SN', 'SE', 'Sédhiou', 'Region',NULL),
('SN-TC', 'SN', 'TC', 'Tambacounda', 'Region',NULL),
('SN-TH', 'SN', 'TH', 'Thiès', 'Region',NULL),
('SN-ZG', 'SN', 'ZG', 'Ziguinchor', 'Region',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('RS', 'SRB', 'Serbia', '', 'Republic of Serbia');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('RS-00', 'RS', '00', 'Beograd', 'City',NULL),
('RS-KM', 'RS', 'KM', 'Kosovo-Metohija', 'Autonomous province',NULL),
('RS-VO', 'RS', 'VO', 'Vojvodina', 'Autonomous province',NULL),
('RS-14', 'RS', '14', 'Borski okrug', 'District',NULL),
('RS-11', 'RS', '11', 'Braničevski okrug', 'District',NULL),
('RS-23', 'RS', '23', 'Jablanički okrug', 'District',NULL),
('RS-06', 'RS', '06', 'Južnobački okrug', 'District','RS-VO'),
('RS-04', 'RS', '04', 'Južnobanatski okrug', 'District','RS-VO'),
('RS-09', 'RS', '09', 'Kolubarski okrug', 'District',NULL),
('RS-25', 'RS', '25', 'Kosovski okrug', 'District','RS-KM'),
('RS-28', 'RS', '28', 'Kosovsko-Mitrovački okrug', 'District','RS-KM'),
('RS-29', 'RS', '29', 'Kosovsko-Pomoravski okrug', 'District','RS-KM'),
('RS-08', 'RS', '08', 'Mačvanski okrug', 'District',NULL),
('RS-17', 'RS', '17', 'Moravički okrug', 'District',NULL),
('RS-20', 'RS', '20', 'Nišavski okrug', 'District',NULL),
('RS-24', 'RS', '24', 'Pčinjski okrug', 'District',NULL),
('RS-26', 'RS', '26', 'Pećki okrug', 'District','RS-KM'),
('RS-22', 'RS', '22', 'Pirotski okrug', 'District',NULL),
('RS-10', 'RS', '10', 'Podunavski okrug', 'District',NULL),
('RS-13', 'RS', '13', 'Pomoravski okrug', 'District',NULL),
('RS-27', 'RS', '27', 'Prizrenski okrug', 'District','RS-KM'),
('RS-19', 'RS', '19', 'Rasinski okrug', 'District',NULL),
('RS-18', 'RS', '18', 'Raški okrug', 'District',NULL),
('RS-01', 'RS', '01', 'Severnobački okrug', 'District','RS-VO'),
('RS-03', 'RS', '03', 'Severnobanatski okrug', 'District','RS-VO'),
('RS-02', 'RS', '02', 'Srednjebanatski okrug', 'District','RS-VO'),
('RS-07', 'RS', '07', 'Sremski okrug', 'District','RS-VO'),
('RS-12', 'RS', '12', 'Šumadijski okrug', 'District',NULL),
('RS-21', 'RS', '21', 'Toplički okrug', 'District',NULL),
('RS-15', 'RS', '15', 'Zaječarski okrug', 'District',NULL),
('RS-05', 'RS', '05', 'Zapadnobački okrug', 'District','RS-VO'),
('RS-16', 'RS', '16', 'Zlatiborski okrug', 'District',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('SC', 'SYC', 'Seychelles', '', 'Republic of Seychelles');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('SC-01', 'SC', '01', 'Anse aux Pins', 'District',NULL),
('SC-02', 'SC', '02', 'Anse Boileau', 'District',NULL),
('SC-03', 'SC', '03', 'Anse Etoile', 'District',NULL),
('SC-04', 'SC', '04', 'Anse Louis', 'District',NULL),
('SC-05', 'SC', '05', 'Anse Royale', 'District',NULL),
('SC-06', 'SC', '06', 'Baie Lazare', 'District',NULL),
('SC-07', 'SC', '07', 'Baie Sainte Anne', 'District',NULL),
('SC-08', 'SC', '08', 'Beau Vallon', 'District',NULL),
('SC-09', 'SC', '09', 'Bel Air', 'District',NULL),
('SC-10', 'SC', '10', 'Bel Ombre', 'District',NULL),
('SC-11', 'SC', '11', 'Cascade', 'District',NULL),
('SC-12', 'SC', '12', 'Glacis', 'District',NULL),
('SC-13', 'SC', '13', 'Grand Anse Mahe', 'District',NULL),
('SC-14', 'SC', '14', 'Grand Anse Praslin', 'District',NULL),
('SC-15', 'SC', '15', 'La Digue', 'District',NULL),
('SC-16', 'SC', '16', 'English River', 'District',NULL),
('SC-24', 'SC', '24', 'Les Mamelles', 'District',NULL),
('SC-17', 'SC', '17', 'Mont Buxton', 'District',NULL),
('SC-18', 'SC', '18', 'Mont Fleuri', 'District',NULL),
('SC-19', 'SC', '19', 'Plaisance', 'District',NULL),
('SC-20', 'SC', '20', 'Pointe Larue', 'District',NULL),
('SC-21', 'SC', '21', 'Port Glaud', 'District',NULL),
('SC-25', 'SC', '25', 'Roche Caiman', 'District',NULL),
('SC-22', 'SC', '22', 'Saint Louis', 'District',NULL),
('SC-23', 'SC', '23', 'Takamaka', 'District',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('SL', 'SLE', 'Sierra Leone', '', 'Republic of Sierra Leone');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('SL-W', 'SL', 'W', 'Western Area (Freetown)', 'Area',NULL),
('SL-E', 'SL', 'E', 'Eastern', 'Province',NULL),
('SL-N', 'SL', 'N', 'Northern', 'Province',NULL),
('SL-S', 'SL', 'S', 'Southern (Sierra Leone)', 'Province',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('SG', 'SGP', 'Singapore', '', 'Republic of Singapore');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('SG-01', 'SG', '01', 'Central Singapore', 'district',NULL),
('SG-02', 'SG', '02', 'North East', 'district',NULL),
('SG-03', 'SG', '03', 'North West', 'district',NULL),
('SG-04', 'SG', '04', 'South East', 'district',NULL),
('SG-05', 'SG', '05', 'South West', 'district',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('SX', 'SXM', 'Sint Maarten (Dutch part)', '', 'Sint Maarten (Dutch part)');

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('SK', 'SVK', 'Slovakia', '', 'Slovak Republic');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('SK-BC', 'SK', 'BC', 'Banskobystrický kraj', 'Region',NULL),
('SK-BL', 'SK', 'BL', 'Bratislavský kraj', 'Region',NULL),
('SK-KI', 'SK', 'KI', 'Košický kraj', 'Region',NULL),
('SK-NI', 'SK', 'NI', 'Nitriansky kraj', 'Region',NULL),
('SK-PV', 'SK', 'PV', 'Prešovský kraj', 'Region',NULL),
('SK-TC', 'SK', 'TC', 'Trenčiansky kraj', 'Region',NULL),
('SK-TA', 'SK', 'TA', 'Trnavský kraj', 'Region',NULL),
('SK-ZI', 'SK', 'ZI', 'Žilinský kraj', 'Region',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('SI', 'SVN', 'Slovenia', '', 'Republic of Slovenia');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('SI-001', 'SI', '001', 'Ajdovščina', 'Municipality',NULL),
('SI-195', 'SI', '195', 'Apače', 'Municipality',NULL),
('SI-002', 'SI', '002', 'Beltinci', 'Municipality',NULL),
('SI-148', 'SI', '148', 'Benedikt', 'Municipality',NULL),
('SI-149', 'SI', '149', 'Bistrica ob Sotli', 'Municipality',NULL),
('SI-003', 'SI', '003', 'Bled', 'Municipality',NULL),
('SI-150', 'SI', '150', 'Bloke', 'Municipality',NULL),
('SI-004', 'SI', '004', 'Bohinj', 'Municipality',NULL),
('SI-005', 'SI', '005', 'Borovnica', 'Municipality',NULL),
('SI-006', 'SI', '006', 'Bovec', 'Municipality',NULL),
('SI-151', 'SI', '151', 'Braslovče', 'Municipality',NULL),
('SI-007', 'SI', '007', 'Brda', 'Municipality',NULL),
('SI-008', 'SI', '008', 'Brezovica', 'Municipality',NULL),
('SI-009', 'SI', '009', 'Brežice', 'Municipality',NULL),
('SI-152', 'SI', '152', 'Cankova', 'Municipality',NULL),
('SI-011', 'SI', '011', 'Celje', 'Municipality',NULL),
('SI-012', 'SI', '012', 'Cerklje na Gorenjskem', 'Municipality',NULL),
('SI-013', 'SI', '013', 'Cerknica', 'Municipality',NULL),
('SI-014', 'SI', '014', 'Cerkno', 'Municipality',NULL),
('SI-153', 'SI', '153', 'Cerkvenjak', 'Municipality',NULL),
('SI-196', 'SI', '196', 'Cirkulane', 'Municipality',NULL),
('SI-015', 'SI', '015', 'Črenšovci', 'Municipality',NULL),
('SI-016', 'SI', '016', 'Črna na Koroškem', 'Municipality',NULL),
('SI-017', 'SI', '017', 'Črnomelj', 'Municipality',NULL),
('SI-018', 'SI', '018', 'Destrnik', 'Municipality',NULL),
('SI-019', 'SI', '019', 'Divača', 'Municipality',NULL),
('SI-154', 'SI', '154', 'Dobje', 'Municipality',NULL),
('SI-020', 'SI', '020', 'Dobrepolje', 'Municipality',NULL),
('SI-155', 'SI', '155', 'Dobrna', 'Municipality',NULL),
('SI-021', 'SI', '021', 'Dobrova-Polhov Gradec', 'Municipality',NULL),
('SI-156', 'SI', '156', 'Dobrovnik/Dobronak', 'Municipality',NULL),
('SI-022', 'SI', '022', 'Dol pri Ljubljani', 'Municipality',NULL),
('SI-157', 'SI', '157', 'Dolenjske Toplice', 'Municipality',NULL),
('SI-023', 'SI', '023', 'Domžale', 'Municipality',NULL),
('SI-024', 'SI', '024', 'Dornava', 'Municipality',NULL),
('SI-025', 'SI', '025', 'Dravograd', 'Municipality',NULL),
('SI-026', 'SI', '026', 'Duplek', 'Municipality',NULL),
('SI-027', 'SI', '027', 'Gorenja vas-Poljane', 'Municipality',NULL),
('SI-028', 'SI', '028', 'Gorišnica', 'Municipality',NULL),
('SI-207', 'SI', '207', 'Gorje', 'Municipality',NULL),
('SI-029', 'SI', '029', 'Gornja Radgona', 'Municipality',NULL),
('SI-030', 'SI', '030', 'Gornji Grad', 'Municipality',NULL),
('SI-031', 'SI', '031', 'Gornji Petrovci', 'Municipality',NULL),
('SI-158', 'SI', '158', 'Grad', 'Municipality',NULL),
('SI-032', 'SI', '032', 'Grosuplje', 'Municipality',NULL),
('SI-159', 'SI', '159', 'Hajdina', 'Municipality',NULL),
('SI-160', 'SI', '160', 'Hoče-Slivnica', 'Municipality',NULL),
('SI-161', 'SI', '161', 'Hodoš/Hodos', 'Municipality',NULL),
('SI-162', 'SI', '162', 'Horjul', 'Municipality',NULL),
('SI-034', 'SI', '034', 'Hrastnik', 'Municipality',NULL),
('SI-035', 'SI', '035', 'Hrpelje-Kozina', 'Municipality',NULL),
('SI-036', 'SI', '036', 'Idrija', 'Municipality',NULL),
('SI-037', 'SI', '037', 'Ig', 'Municipality',NULL),
('SI-038', 'SI', '038', 'Ilirska Bistrica', 'Municipality',NULL),
('SI-039', 'SI', '039', 'Ivančna Gorica', 'Municipality',NULL),
('SI-040', 'SI', '040', 'Izola/Isola', 'Municipality',NULL),
('SI-041', 'SI', '041', 'Jesenice', 'Municipality',NULL),
('SI-163', 'SI', '163', 'Jezersko', 'Municipality',NULL),
('SI-042', 'SI', '042', 'Juršinci', 'Municipality',NULL),
('SI-043', 'SI', '043', 'Kamnik', 'Municipality',NULL),
('SI-044', 'SI', '044', 'Kanal', 'Municipality',NULL),
('SI-045', 'SI', '045', 'Kidričevo', 'Municipality',NULL),
('SI-046', 'SI', '046', 'Kobarid', 'Municipality',NULL),
('SI-047', 'SI', '047', 'Kobilje', 'Municipality',NULL),
('SI-048', 'SI', '048', 'Kočevje', 'Municipality',NULL),
('SI-049', 'SI', '049', 'Komen', 'Municipality',NULL),
('SI-164', 'SI', '164', 'Komenda', 'Municipality',NULL),
('SI-050', 'SI', '050', 'Koper/Capodistria', 'Municipality',NULL),
('SI-197', 'SI', '197', 'Kosanjevica na Krki', 'Municipality',NULL),
('SI-165', 'SI', '165', 'Kostel', 'Municipality',NULL),
('SI-051', 'SI', '051', 'Kozje', 'Municipality',NULL),
('SI-052', 'SI', '052', 'Kranj', 'Municipality',NULL),
('SI-053', 'SI', '053', 'Kranjska Gora', 'Municipality',NULL),
('SI-166', 'SI', '166', 'Križevci', 'Municipality',NULL),
('SI-054', 'SI', '054', 'Krško', 'Municipality',NULL),
('SI-055', 'SI', '055', 'Kungota', 'Municipality',NULL),
('SI-056', 'SI', '056', 'Kuzma', 'Municipality',NULL),
('SI-057', 'SI', '057', 'Laško', 'Municipality',NULL),
('SI-058', 'SI', '058', 'Lenart', 'Municipality',NULL),
('SI-059', 'SI', '059', 'Lendava/Lendva', 'Municipality',NULL),
('SI-060', 'SI', '060', 'Litija', 'Municipality',NULL),
('SI-061', 'SI', '061', 'Ljubljana', 'Municipality',NULL),
('SI-062', 'SI', '062', 'Ljubno', 'Municipality',NULL),
('SI-063', 'SI', '063', 'Ljutomer', 'Municipality',NULL),
('SI-208', 'SI', '208', 'Log-Dragomer', 'Municipality',NULL),
('SI-064', 'SI', '064', 'Logatec', 'Municipality',NULL),
('SI-065', 'SI', '065', 'Loška dolina', 'Municipality',NULL),
('SI-066', 'SI', '066', 'Loški Potok', 'Municipality',NULL),
('SI-167', 'SI', '167', 'Lovrenc na Pohorju', 'Municipality',NULL),
('SI-067', 'SI', '067', 'Luče', 'Municipality',NULL),
('SI-068', 'SI', '068', 'Lukovica', 'Municipality',NULL),
('SI-069', 'SI', '069', 'Majšperk', 'Municipality',NULL),
('SI-198', 'SI', '198', 'Makole', 'Municipality',NULL),
('SI-070', 'SI', '070', 'Maribor', 'Municipality',NULL),
('SI-168', 'SI', '168', 'Markovci', 'Municipality',NULL),
('SI-071', 'SI', '071', 'Medvode', 'Municipality',NULL),
('SI-072', 'SI', '072', 'Mengeš', 'Municipality',NULL),
('SI-073', 'SI', '073', 'Metlika', 'Municipality',NULL),
('SI-074', 'SI', '074', 'Mežica', 'Municipality',NULL),
('SI-169', 'SI', '169', 'Miklavž na Dravskem polju', 'Municipality',NULL),
('SI-075', 'SI', '075', 'Miren-Kostanjevica', 'Municipality',NULL),
('SI-170', 'SI', '170', 'Mirna Peč', 'Municipality',NULL),
('SI-076', 'SI', '076', 'Mislinja', 'Municipality',NULL),
('SI-199', 'SI', '199', 'Mokronog-Trebelno', 'Municipality',NULL),
('SI-077', 'SI', '077', 'Moravče', 'Municipality',NULL),
('SI-078', 'SI', '078', 'Moravske Toplice', 'Municipality',NULL),
('SI-079', 'SI', '079', 'Mozirje', 'Municipality',NULL),
('SI-080', 'SI', '080', 'Murska Sobota', 'Municipality',NULL),
('SI-081', 'SI', '081', 'Muta', 'Municipality',NULL),
('SI-082', 'SI', '082', 'Naklo', 'Municipality',NULL),
('SI-083', 'SI', '083', 'Nazarje', 'Municipality',NULL),
('SI-084', 'SI', '084', 'Nova Gorica', 'Municipality',NULL),
('SI-085', 'SI', '085', 'Novo mesto', 'Municipality',NULL),
('SI-086', 'SI', '086', 'Odranci', 'Municipality',NULL),
('SI-171', 'SI', '171', 'Oplotnica', 'Municipality',NULL),
('SI-087', 'SI', '087', 'Ormož', 'Municipality',NULL),
('SI-088', 'SI', '088', 'Osilnica', 'Municipality',NULL),
('SI-089', 'SI', '089', 'Pesnica', 'Municipality',NULL),
('SI-090', 'SI', '090', 'Piran/Pirano', 'Municipality',NULL),
('SI-091', 'SI', '091', 'Pivka', 'Municipality',NULL),
('SI-092', 'SI', '092', 'Podčetrtek', 'Municipality',NULL),
('SI-172', 'SI', '172', 'Podlehnik', 'Municipality',NULL),
('SI-093', 'SI', '093', 'Podvelka', 'Municipality',NULL),
('SI-200', 'SI', '200', 'Poljčane', 'Municipality',NULL),
('SI-173', 'SI', '173', 'Polzela', 'Municipality',NULL),
('SI-094', 'SI', '094', 'Postojna', 'Municipality',NULL),
('SI-174', 'SI', '174', 'Prebold', 'Municipality',NULL),
('SI-095', 'SI', '095', 'Preddvor', 'Municipality',NULL),
('SI-175', 'SI', '175', 'Prevalje', 'Municipality',NULL),
('SI-096', 'SI', '096', 'Ptuj', 'Municipality',NULL),
('SI-097', 'SI', '097', 'Puconci', 'Municipality',NULL),
('SI-098', 'SI', '098', 'Rače-Fram', 'Municipality',NULL),
('SI-099', 'SI', '099', 'Radeče', 'Municipality',NULL),
('SI-100', 'SI', '100', 'Radenci', 'Municipality',NULL),
('SI-101', 'SI', '101', 'Radlje ob Dravi', 'Municipality',NULL),
('SI-102', 'SI', '102', 'Radovljica', 'Municipality',NULL),
('SI-103', 'SI', '103', 'Ravne na Koroškem', 'Municipality',NULL),
('SI-176', 'SI', '176', 'Razkrižje', 'Municipality',NULL),
('SI-209', 'SI', '209', 'Rečica ob Savinji', 'Municipality',NULL),
('SI-201', 'SI', '201', 'Renče-Vogrsko', 'Municipality',NULL),
('SI-104', 'SI', '104', 'Ribnica', 'Municipality',NULL),
('SI-177', 'SI', '177', 'Ribnica na Pohorju', 'Municipality',NULL),
('SI-106', 'SI', '106', 'Rogaška Slatina', 'Municipality',NULL),
('SI-105', 'SI', '105', 'Rogašovci', 'Municipality',NULL),
('SI-107', 'SI', '107', 'Rogatec', 'Municipality',NULL),
('SI-108', 'SI', '108', 'Ruše', 'Municipality',NULL),
('SI-178', 'SI', '178', 'Selnica ob Dravi', 'Municipality',NULL),
('SI-109', 'SI', '109', 'Semič', 'Municipality',NULL),
('SI-110', 'SI', '110', 'Sevnica', 'Municipality',NULL),
('SI-111', 'SI', '111', 'Sežana', 'Municipality',NULL),
('SI-112', 'SI', '112', 'Slovenj Gradec', 'Municipality',NULL),
('SI-113', 'SI', '113', 'Slovenska Bistrica', 'Municipality',NULL),
('SI-114', 'SI', '114', 'Slovenske Konjice', 'Municipality',NULL),
('SI-179', 'SI', '179', 'Sodražica', 'Municipality',NULL),
('SI-180', 'SI', '180', 'Solčava', 'Municipality',NULL),
('SI-202', 'SI', '202', 'Središče ob Dravi', 'Municipality',NULL),
('SI-115', 'SI', '115', 'Starče', 'Municipality',NULL),
('SI-203', 'SI', '203', 'Straža', 'Municipality',NULL),
('SI-181', 'SI', '181', 'Sveta Ana', 'Municipality',NULL),
('SI-204', 'SI', '204', 'Sveta Trojica v Slovenskih Goricah', 'Municipality',NULL),
('SI-182', 'SI', '182', 'Sveta Andraž v Slovenskih Goricah', 'Municipality',NULL),
('SI-116', 'SI', '116', 'Sveti Jurij', 'Municipality',NULL),
('SI-210', 'SI', '210', 'Sveti Jurij v Slovenskih Goricah', 'Municipality',NULL),
('SI-205', 'SI', '205', 'Sveti Tomaž', 'Municipality',NULL),
('SI-033', 'SI', '033', 'Šalovci', 'Municipality',NULL),
('SI-183', 'SI', '183', 'Šempeter-Vrtojba', 'Municipality',NULL),
('SI-117', 'SI', '117', 'Šenčur', 'Municipality',NULL),
('SI-118', 'SI', '118', 'Šentilj', 'Municipality',NULL),
('SI-119', 'SI', '119', 'Šentjernej', 'Municipality',NULL),
('SI-120', 'SI', '120', 'Šentjur', 'Municipality',NULL),
('SI-211', 'SI', '211', 'Šentrupert', 'Municipality',NULL),
('SI-121', 'SI', '121', 'Škocjan', 'Municipality',NULL),
('SI-122', 'SI', '122', 'Škofja Loka', 'Municipality',NULL),
('SI-123', 'SI', '123', 'Škofljica', 'Municipality',NULL),
('SI-124', 'SI', '124', 'Šmarje pri Jelšah', 'Municipality',NULL),
('SI-206', 'SI', '206', 'Šmarjeske Topliče', 'Municipality',NULL),
('SI-125', 'SI', '125', 'Šmartno ob Paki', 'Municipality',NULL),
('SI-194', 'SI', '194', 'Šmartno pri Litiji', 'Municipality',NULL),
('SI-126', 'SI', '126', 'Šoštanj', 'Municipality',NULL),
('SI-127', 'SI', '127', 'Štore', 'Municipality',NULL),
('SI-184', 'SI', '184', 'Tabor', 'Municipality',NULL),
('SI-010', 'SI', '010', 'Tišina', 'Municipality',NULL),
('SI-128', 'SI', '128', 'Tolmin', 'Municipality',NULL),
('SI-129', 'SI', '129', 'Trbovlje', 'Municipality',NULL),
('SI-130', 'SI', '130', 'Trebnje', 'Municipality',NULL),
('SI-185', 'SI', '185', 'Trnovska vas', 'Municipality',NULL),
('SI-186', 'SI', '186', 'Trzin', 'Municipality',NULL),
('SI-131', 'SI', '131', 'Tržič', 'Municipality',NULL),
('SI-132', 'SI', '132', 'Turnišče', 'Municipality',NULL),
('SI-133', 'SI', '133', 'Velenje', 'Municipality',NULL),
('SI-187', 'SI', '187', 'Velika Polana', 'Municipality',NULL),
('SI-134', 'SI', '134', 'Velike Lašče', 'Municipality',NULL),
('SI-188', 'SI', '188', 'Veržej', 'Municipality',NULL),
('SI-135', 'SI', '135', 'Videm', 'Municipality',NULL),
('SI-136', 'SI', '136', 'Vipava', 'Municipality',NULL),
('SI-137', 'SI', '137', 'Vitanje', 'Municipality',NULL),
('SI-138', 'SI', '138', 'Vodice', 'Municipality',NULL),
('SI-139', 'SI', '139', 'Vojnik', 'Municipality',NULL),
('SI-189', 'SI', '189', 'Vransko', 'Municipality',NULL),
('SI-140', 'SI', '140', 'Vrhnika', 'Municipality',NULL),
('SI-141', 'SI', '141', 'Vuzenica', 'Municipality',NULL),
('SI-142', 'SI', '142', 'Zagorje ob Savi', 'Municipality',NULL),
('SI-143', 'SI', '143', 'Zavrč', 'Municipality',NULL),
('SI-144', 'SI', '144', 'Zreče', 'Municipality',NULL),
('SI-190', 'SI', '190', 'Žalec', 'Municipality',NULL),
('SI-146', 'SI', '146', 'Železniki', 'Municipality',NULL),
('SI-191', 'SI', '191', 'Žetale', 'Municipality',NULL),
('SI-147', 'SI', '147', 'Žiri', 'Municipality',NULL),
('SI-192', 'SI', '192', 'Žirovnica', 'Municipality',NULL),
('SI-193', 'SI', '193', 'Žužemberk', 'Municipality',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('SB', 'SLB', 'Solomon Islands', '', '');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('SB-CT', 'SB', 'CT', 'Capital Territory (Honiara)', 'Capital territory',NULL),
('SB-CE', 'SB', 'CE', 'Central', 'Province',NULL),
('SB-CH', 'SB', 'CH', 'Choiseul', 'Province',NULL),
('SB-GU', 'SB', 'GU', 'Guadalcanal', 'Province',NULL),
('SB-IS', 'SB', 'IS', 'Isabel', 'Province',NULL),
('SB-MK', 'SB', 'MK', 'Makira', 'Province',NULL),
('SB-ML', 'SB', 'ML', 'Malaita', 'Province',NULL),
('SB-RB', 'SB', 'RB', 'Rennell and Bellona', 'Province',NULL),
('SB-TE', 'SB', 'TE', 'Temotu', 'Province',NULL),
('SB-WE', 'SB', 'WE', 'Western', 'Province',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('SO', 'SOM', 'Somalia', '', 'Federal Republic of Somalia');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('SO-AW', 'SO', 'AW', 'Awdal', 'Region',NULL),
('SO-BK', 'SO', 'BK', 'Bakool', 'Region',NULL),
('SO-BN', 'SO', 'BN', 'Banaadir', 'Region',NULL),
('SO-BR', 'SO', 'BR', 'Bari', 'Region',NULL),
('SO-BY', 'SO', 'BY', 'Bay', 'Region',NULL),
('SO-GA', 'SO', 'GA', 'Galguduud', 'Region',NULL),
('SO-GE', 'SO', 'GE', 'Gedo', 'Region',NULL),
('SO-HI', 'SO', 'HI', 'Hiirsan', 'Region',NULL),
('SO-JD', 'SO', 'JD', 'Jubbada Dhexe', 'Region',NULL),
('SO-JH', 'SO', 'JH', 'Jubbada Hoose', 'Region',NULL),
('SO-MU', 'SO', 'MU', 'Mudug', 'Region',NULL),
('SO-NU', 'SO', 'NU', 'Nugaal', 'Region',NULL),
('SO-SA', 'SO', 'SA', 'Saneag', 'Region',NULL),
('SO-SD', 'SO', 'SD', 'Shabeellaha Dhexe', 'Region',NULL),
('SO-SH', 'SO', 'SH', 'Shabeellaha Hoose', 'Region',NULL),
('SO-SO', 'SO', 'SO', 'Sool', 'Region',NULL),
('SO-TO', 'SO', 'TO', 'Togdheer', 'Region',NULL),
('SO-WO', 'SO', 'WO', 'Woqooyi Galbeed', 'Region',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('ZA', 'ZAF', 'South Africa', '', 'Republic of South Africa');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('ZA-EC', 'ZA', 'EC', 'Eastern Cape', 'Province',NULL),
('ZA-FS', 'ZA', 'FS', 'Free State', 'Province',NULL),
('ZA-GP', 'ZA', 'GP', 'Gauteng', 'Province',NULL),
('ZA-ZN', 'ZA', 'ZN', 'Kwazulu-Natal', 'Province',NULL),
('ZA-LP', 'ZA', 'LP', 'Limpopo', 'Province',NULL),
('ZA-MP', 'ZA', 'MP', 'Mpumalanga', 'Province',NULL),
('ZA-NC', 'ZA', 'NC', 'Northern Cape', 'Province',NULL),
('ZA-NW', 'ZA', 'NW', 'North-West (South Africa)', 'Province',NULL),
('ZA-WC', 'ZA', 'WC', 'Western Cape', 'Province',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('GS', 'SGS', 'South Georgia and the South Sandwich Islands', '', '');

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('ES', 'ESP', 'Spain', '', 'Kingdom of Spain');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('ES-AN', 'ES', 'AN', 'Andalucía', 'Autonomous community',NULL),
('ES-AR', 'ES', 'AR', 'Aragón', 'Autonomous community',NULL),
('ES-AS', 'ES', 'AS', 'Asturias, Principado de', 'Autonomous community',NULL),
('ES-CN', 'ES', 'CN', 'Canarias', 'Autonomous community',NULL),
('ES-CB', 'ES', 'CB', 'Cantabria', 'Autonomous community',NULL),
('ES-CM', 'ES', 'CM', 'Castilla-La Mancha', 'Autonomous community',NULL),
('ES-CL', 'ES', 'CL', 'Castilla y León', 'Autonomous community',NULL),
('ES-CT', 'ES', 'CT', 'Catalunya', 'Autonomous community',NULL),
('ES-EX', 'ES', 'EX', 'Extremadura', 'Autonomous community',NULL),
('ES-GA', 'ES', 'GA', 'Galicia', 'Autonomous community',NULL),
('ES-IB', 'ES', 'IB', 'Illes Balears', 'Autonomous community',NULL),
('ES-RI', 'ES', 'RI', 'La Rioja', 'Autonomous community',NULL),
('ES-MD', 'ES', 'MD', 'Madrid, Comunidad de', 'Autonomous community',NULL),
('ES-MC', 'ES', 'MC', 'Murcia, Región de', 'Autonomous community',NULL),
('ES-NC', 'ES', 'NC', 'Navarra, Comunidad Foral de / Nafarroako Foru Komunitatea', 'Autonomous community',NULL),
('ES-PV', 'ES', 'PV', 'País Vasco / Euskal Herria', 'Autonomous community',NULL),
('ES-VC', 'ES', 'VC', 'Valenciana, Comunidad / Valenciana, Comunitat ', 'Autonomous community',NULL),
('ES-C', 'ES', 'C', 'A Coruña', 'Province','ES-GA'),
('ES-VI', 'ES', 'VI', 'Álava', 'Province','ES-PV'),
('ES-AB', 'ES', 'AB', 'Albacete', 'Province','ES-CM'),
('ES-A', 'ES', 'A', 'Alicante', 'Province','ES-VC'),
('ES-AL', 'ES', 'AL', 'Almería', 'Province','ES-AN'),
('ES-O', 'ES', 'O', 'Asturias', 'Province','ES-AS'),
('ES-AV', 'ES', 'AV', 'Ávila', 'Province','ES-CL'),
('ES-BA', 'ES', 'BA', 'Badajoz', 'Province','ES-EX'),
('ES-B', 'ES', 'B', 'Barcelona', 'Province','ES-CT'),
('ES-BU', 'ES', 'BU', 'Burgos', 'Province','ES-CL'),
('ES-CC', 'ES', 'CC', 'Cáceres', 'Province','ES-EX'),
('ES-CA', 'ES', 'CA', 'Cádiz', 'Province','ES-AN'),
('ES-S', 'ES', 'S', 'Cantabria', 'Province','ES-CB'),
('ES-CS', 'ES', 'CS', 'Castellón', 'Province','ES-VC'),
('ES-CR', 'ES', 'CR', 'Ciudad Real', 'Province','ES-CM'),
('ES-CO', 'ES', 'CO', 'Córdoba', 'Province','ES-AN'),
('ES-CU', 'ES', 'CU', 'Cuenca', 'Province','ES-CM'),
('ES-GI', 'ES', 'GI', 'Girona', 'Province','ES-CT'),
('ES-GR', 'ES', 'GR', 'Granada', 'Province','ES-AN'),
('ES-GU', 'ES', 'GU', 'Guadalajara', 'Province','ES-CM'),
('ES-SS', 'ES', 'SS', 'Guipúzcoa / Gipuzkoa', 'Province','ES-PV'),
('ES-H', 'ES', 'H', 'Huelva', 'Province','ES-AN'),
('ES-HU', 'ES', 'HU', 'Huesca', 'Province','ES-AR'),
('ES-J', 'ES', 'J', 'Jaén', 'Province','ES-AN'),
('ES-LO', 'ES', 'LO', 'La Rioja', 'Province','ES-RI'),
('ES-GC', 'ES', 'GC', 'Las Palmas', 'Province','ES-CN'),
('ES-LE', 'ES', 'LE', 'León', 'Province','ES-CL'),
('ES-L', 'ES', 'L', 'Lleida', 'Province','ES-CT'),
('ES-LU', 'ES', 'LU', 'Lugo', 'Province','ES-GA'),
('ES-M', 'ES', 'M', 'Madrid', 'Province','ES-MD'),
('ES-MA', 'ES', 'MA', 'Málaga', 'Province','ES-AN'),
('ES-MU', 'ES', 'MU', 'Murcia', 'Province','ES-MC'),
('ES-NA', 'ES', 'NA', 'Navarra / Nafarroa', 'Province','ES-NC'),
('ES-OR', 'ES', 'OR', 'Ourense', 'Province','ES-GA'),
('ES-P', 'ES', 'P', 'Palencia', 'Province','ES-CL'),
('ES-PM', 'ES', 'PM', 'Balears', 'Province','ES-IB'),
('ES-PO', 'ES', 'PO', 'Pontevedra', 'Province','ES-GA'),
('ES-SA', 'ES', 'SA', 'Salamanca', 'Province','ES-CL'),
('ES-TF', 'ES', 'TF', 'Santa Cruz de Tenerife', 'Province','ES-CN'),
('ES-SG', 'ES', 'SG', 'Segovia', 'Province','ES-CL'),
('ES-SE', 'ES', 'SE', 'Sevilla', 'Province','ES-AN'),
('ES-SO', 'ES', 'SO', 'Soria', 'Province','ES-CL'),
('ES-T', 'ES', 'T', 'Tarragona', 'Province','ES-CT'),
('ES-TE', 'ES', 'TE', 'Teruel', 'Province','ES-AR'),
('ES-TO', 'ES', 'TO', 'Toledo', 'Province','ES-CM'),
('ES-V', 'ES', 'V', 'Valencia / València', 'Province','ES-VC'),
('ES-VA', 'ES', 'VA', 'Valladolid', 'Province','ES-CL'),
('ES-BI', 'ES', 'BI', 'Vizcayaa / Bizkaia', 'Province','ES-PV'),
('ES-ZA', 'ES', 'ZA', 'Zamora', 'Province','ES-CL'),
('ES-Z', 'ES', 'Z', 'Zaragoza', 'Province','ES-AR'),
('ES-CE', 'ES', 'CE', 'Ceuta', 'Autonomous city',NULL),
('ES-ML', 'ES', 'ML', 'Melilla', 'Autonomous city',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('LK', 'LKA', 'Sri Lanka', '', 'Democratic Socialist Republic of Sri Lanka');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('LK-1', 'LK', '1', 'Basnāhira paḷāta', 'Province',NULL),
('LK-3', 'LK', '3', 'Dakuṇu paḷāta', 'Province',NULL),
('LK-2', 'LK', '2', 'Madhyama paḷāta', 'Province',NULL),
('LK-5', 'LK', '5', 'Næ̆gĕnahira paḷāta', 'Province',NULL),
('LK-9', 'LK', '9', 'Sabaragamuva paḷāta', 'Province',NULL),
('LK-7', 'LK', '7', 'Uturumæ̆da paḷāta', 'Province',NULL),
('LK-4', 'LK', '4', 'Uturu paḷāta', 'Province',NULL),
('LK-8', 'LK', '8', 'Ūva paḷāta', 'Province',NULL),
('LK-6', 'LK', '6', 'Vayamba paḷāta', 'Province',NULL),
('LK-52', 'LK', '52', 'Ampāara', 'District','LK-5'),
('LK-71', 'LK', '71', 'Anurādhapura', 'District','LK-7'),
('LK-81', 'LK', '81', 'Badulla', 'District','LK-8'),
('LK-51', 'LK', '51', 'Maḍakalapuva', 'District','LK-5'),
('LK-11', 'LK', '11', 'Kŏḷamba', 'District','LK-1'),
('LK-31', 'LK', '31', 'Gālla', 'District','LK-3'),
('LK-12', 'LK', '12', 'Gampaha', 'District','LK-1'),
('LK-33', 'LK', '33', 'Hambantŏṭa', 'District','LK-3'),
('LK-41', 'LK', '41', 'Yāpanaya', 'District','LK-4'),
('LK-13', 'LK', '13', 'Kaḷutara', 'District','LK-1'),
('LK-21', 'LK', '21', 'Mahanuvara', 'District','LK-2'),
('LK-92', 'LK', '92', 'Kægalla', 'District','LK-9'),
('LK-42', 'LK', '42', 'Kilinŏchchi', 'District','LK-4'),
('LK-61', 'LK', '61', 'Kuruṇægala', 'District','LK-6'),
('LK-43', 'LK', '43', 'Mannārama', 'District','LK-4'),
('LK-22', 'LK', '22', 'Mātale', 'District','LK-2'),
('LK-32', 'LK', '32', 'Mātara', 'District','LK-3'),
('LK-82', 'LK', '82', 'Mŏṇarāgala', 'District','LK-8'),
('LK-45', 'LK', '45', 'Mulativ', 'District','LK-4'),
('LK-23', 'LK', '23', 'Nuvara Ĕliya', 'District','LK-2'),
('LK-72', 'LK', '72', 'Pŏḷŏnnaruva', 'District','LK-7'),
('LK-62', 'LK', '62', 'Puttalama', 'District','LK-6'),
('LK-91', 'LK', '91', 'Ratnapura', 'District','LK-9'),
('LK-53', 'LK', '53', 'Trikuṇāmalaya', 'District','LK-5'),
('LK-44', 'LK', '44', 'Vavuniyāva', 'District','LK-4');

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('SD', 'SDN', 'Sudan', '', 'Republic of the Sudan');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('SD-RS', 'SD', 'RS', 'Al Baḩr al Aḩmar', 'state',NULL),
('SD-GZ', 'SD', 'GZ', 'Al Jazīrah', 'state',NULL),
('SD-KH', 'SD', 'KH', 'Al Kharţūm', 'state',NULL),
('SD-GD', 'SD', 'GD', 'Al Qaḑārif', 'state',NULL),
('SD-NR', 'SD', 'NR', 'An Nīl', 'state',NULL),
('SD-NW', 'SD', 'NW', 'An Nīl al Abyaḑ', 'state',NULL),
('SD-NB', 'SD', 'NB', 'An Nīl al Azraq', 'state',NULL),
('SD-NO', 'SD', 'NO', 'Ash Shamālīyah', 'state',NULL),
('SD-DW', 'SD', 'DW', 'Gharb Dārfūr', 'state',NULL),
('SD-DS', 'SD', 'DS', 'Janūb Dārfūr', 'state',NULL),
('SD-KS', 'SD', 'KS', 'Janūb Kurdufān', 'state',NULL),
('SD-KA', 'SD', 'KA', 'Kassalā', 'state',NULL),
('SD-DN', 'SD', 'DN', 'Shamāl Dārfūr', 'state',NULL),
('SD-KN', 'SD', 'KN', 'Shamāl Kurdufān', 'state',NULL),
('SD-DE', 'SD', 'DE', 'Sharq Dārfūr', 'state',NULL),
('SD-SI', 'SD', 'SI', 'Sinnār', 'state',NULL),
('SD-DC', 'SD', 'DC', 'Zalingei', 'state',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('SR', 'SUR', 'Suriname', '', 'Republic of Suriname');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('SR-BR', 'SR', 'BR', 'Brokopondo', 'District',NULL),
('SR-CM', 'SR', 'CM', 'Commewijne', 'District',NULL),
('SR-CR', 'SR', 'CR', 'Coronie', 'District',NULL),
('SR-MA', 'SR', 'MA', 'Marowijne', 'District',NULL),
('SR-NI', 'SR', 'NI', 'Nickerie', 'District',NULL),
('SR-PR', 'SR', 'PR', 'Para', 'District',NULL),
('SR-PM', 'SR', 'PM', 'Paramaribo', 'District',NULL),
('SR-SA', 'SR', 'SA', 'Saramacca', 'District',NULL),
('SR-SI', 'SR', 'SI', 'Sipaliwini', 'District',NULL),
('SR-WA', 'SR', 'WA', 'Wanica', 'District',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('SS', 'SSD', 'South Sudan', '', 'Republic of South Sudan');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('SS-EC', 'SS', 'EC', 'Central Equatoria', 'state',NULL),
('SS-EE8', 'SS', 'EE8', 'Eastern Equatoria', 'state',NULL),
('SS-JG', 'SS', 'JG', 'Jonglei', 'state',NULL),
('SS-LK', 'SS', 'LK', 'Lakes', 'state',NULL),
('SS-BN', 'SS', 'BN', 'Northern Bahr el-Ghazal', 'state',NULL),
('SS-UY', 'SS', 'UY', 'Unity', 'state',NULL),
('SS-NU', 'SS', 'NU', 'Upper Nile', 'state',NULL),
('SS-WR', 'SS', 'WR', 'Warrap', 'state',NULL),
('SS-BW', 'SS', 'BW', 'Western Bahr el-Ghazal', 'state',NULL),
('SS-EW', 'SS', 'EW', 'Western Equatoria', 'state',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('SJ', 'SJM', 'Svalbard and Jan Mayen', '', '');

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('SZ', 'SWZ', 'Swaziland', '', 'Kingdom of Swaziland');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('SZ-HH', 'SZ', 'HH', 'Hhohho', 'District',NULL),
('SZ-LU', 'SZ', 'LU', 'Lubombo', 'District',NULL),
('SZ-MA', 'SZ', 'MA', 'Manzini', 'District',NULL),
('SZ-SH', 'SZ', 'SH', 'Shiselweni', 'District',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('SE', 'SWE', 'Sweden', '', 'Kingdom of Sweden');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('SE-K', 'SE', 'K', 'Blekinge län', 'County',NULL),
('SE-W', 'SE', 'W', 'Dalarnas län', 'County',NULL),
('SE-I', 'SE', 'I', 'Gotlands län', 'County',NULL),
('SE-X', 'SE', 'X', 'Gävleborgs län', 'County',NULL),
('SE-N', 'SE', 'N', 'Hallands län', 'County',NULL),
('SE-Z', 'SE', 'Z', 'Jämtlands län', 'County',NULL),
('SE-F', 'SE', 'F', 'Jönköpings län', 'County',NULL),
('SE-H', 'SE', 'H', 'Kalmar län', 'County',NULL),
('SE-G', 'SE', 'G', 'Kronobergs län', 'County',NULL),
('SE-BD', 'SE', 'BD', 'Norrbottens län', 'County',NULL),
('SE-M', 'SE', 'M', 'Skåne län', 'County',NULL),
('SE-AB', 'SE', 'AB', 'Stockholms län', 'County',NULL),
('SE-D', 'SE', 'D', 'Södermanlands län', 'County',NULL),
('SE-C', 'SE', 'C', 'Uppsala län', 'County',NULL),
('SE-S', 'SE', 'S', 'Värmlands län', 'County',NULL),
('SE-AC', 'SE', 'AC', 'Västerbottens län', 'County',NULL),
('SE-Y', 'SE', 'Y', 'Västernorrlands län', 'County',NULL),
('SE-U', 'SE', 'U', 'Västmanlands län', 'County',NULL),
('SE-O', 'SE', 'O', 'Västra Götalands län', 'County',NULL),
('SE-T', 'SE', 'T', 'Örebro län', 'County',NULL),
('SE-E', 'SE', 'E', 'Östergötlands län', 'County',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('CH', 'CHE', 'Switzerland', '', 'Swiss Confederation');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('CH-AG', 'CH', 'AG', 'Aargau', 'Canton',NULL),
('CH-AI', 'CH', 'AI', 'Appenzell Innerrhoden', 'Canton',NULL),
('CH-AR', 'CH', 'AR', 'Appenzell Ausserrhoden', 'Canton',NULL),
('CH-BE', 'CH', 'BE', 'Bern', 'Canton',NULL),
('CH-BL', 'CH', 'BL', 'Basel-Landschaft', 'Canton',NULL),
('CH-BS', 'CH', 'BS', 'Basel-Stadt', 'Canton',NULL),
('CH-FR', 'CH', 'FR', 'Fribourg', 'Canton',NULL),
('CH-GE', 'CH', 'GE', 'Genève', 'Canton',NULL),
('CH-GL', 'CH', 'GL', 'Glarus', 'Canton',NULL),
('CH-GR', 'CH', 'GR', 'Graubünden', 'Canton',NULL),
('CH-JU', 'CH', 'JU', 'Jura', 'Canton',NULL),
('CH-LU', 'CH', 'LU', 'Luzern', 'Canton',NULL),
('CH-NE', 'CH', 'NE', 'Neuchâtel', 'Canton',NULL),
('CH-NW', 'CH', 'NW', 'Nidwalden', 'Canton',NULL),
('CH-OW', 'CH', 'OW', 'Obwalden', 'Canton',NULL),
('CH-SG', 'CH', 'SG', 'Sankt Gallen', 'Canton',NULL),
('CH-SH', 'CH', 'SH', 'Schaffhausen', 'Canton',NULL),
('CH-SO', 'CH', 'SO', 'Solothurn', 'Canton',NULL),
('CH-SZ', 'CH', 'SZ', 'Schwyz', 'Canton',NULL),
('CH-TG', 'CH', 'TG', 'Thurgau', 'Canton',NULL),
('CH-TI', 'CH', 'TI', 'Ticino', 'Canton',NULL),
('CH-UR', 'CH', 'UR', 'Uri', 'Canton',NULL),
('CH-VD', 'CH', 'VD', 'Vaud', 'Canton',NULL),
('CH-VS', 'CH', 'VS', 'Valais', 'Canton',NULL),
('CH-ZG', 'CH', 'ZG', 'Zug', 'Canton',NULL),
('CH-ZH', 'CH', 'ZH', 'Zürich', 'Canton',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('SY', 'SYR', 'Syrian Arab Republic', '', '');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('SY-HA', 'SY', 'HA', 'Al Hasakah', 'Governorate',NULL),
('SY-LA', 'SY', 'LA', 'Al Ladhiqiyah', 'Governorate',NULL),
('SY-QU', 'SY', 'QU', 'Al Qunaytirah', 'Governorate',NULL),
('SY-RA', 'SY', 'RA', 'Ar Raqqah', 'Governorate',NULL),
('SY-SU', 'SY', 'SU', 'As Suwayda''', 'Governorate',NULL),
('SY-DR', 'SY', 'DR', 'Dar''a', 'Governorate',NULL),
('SY-DY', 'SY', 'DY', 'Dayr az Zawr', 'Governorate',NULL),
('SY-DI', 'SY', 'DI', 'Dimashq', 'Governorate',NULL),
('SY-HL', 'SY', 'HL', 'Halab', 'Governorate',NULL),
('SY-HM', 'SY', 'HM', 'Hamah', 'Governorate',NULL),
('SY-HI', 'SY', 'HI', 'Homs', 'Governorate',NULL),
('SY-ID', 'SY', 'ID', 'Idlib', 'Governorate',NULL),
('SY-RD', 'SY', 'RD', 'Rif Dimashq', 'Governorate',NULL),
('SY-TA', 'SY', 'TA', 'Tartus', 'Governorate',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('TW', 'TWN', 'Taiwan, Province of China', 'Taiwan', 'Taiwan, Province of China');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('TW-CHA', 'TW', 'CHA', 'Changhua', 'District',NULL),
('TW-CYQ', 'TW', 'CYQ', 'Chiayi', 'District',NULL),
('TW-HSQ', 'TW', 'HSQ', 'Hsinchu', 'District',NULL),
('TW-HUA', 'TW', 'HUA', 'Hualien', 'District',NULL),
('TW-ILA', 'TW', 'ILA', 'Ilan', 'District',NULL),
('TW-KHQ', 'TW', 'KHQ', 'Kaohsiung', 'District',NULL),
('TW-MIA', 'TW', 'MIA', 'Miaoli', 'District',NULL),
('TW-NAN', 'TW', 'NAN', 'Nantou', 'District',NULL),
('TW-PEN', 'TW', 'PEN', 'Penghu', 'District',NULL),
('TW-PIF', 'TW', 'PIF', 'Pingtung', 'District',NULL),
('TW-TXQ', 'TW', 'TXQ', 'Taichung', 'District',NULL),
('TW-TNQ', 'TW', 'TNQ', 'Tainan', 'District',NULL),
('TW-TPQ', 'TW', 'TPQ', 'Taipei', 'District',NULL),
('TW-TTT', 'TW', 'TTT', 'Taitung', 'District',NULL),
('TW-TAO', 'TW', 'TAO', 'Taoyuan', 'District',NULL),
('TW-YUN', 'TW', 'YUN', 'Yunlin', 'District',NULL),
('TW-CYI', 'TW', 'CYI', 'Chiay City', 'Municipality',NULL),
('TW-HSZ', 'TW', 'HSZ', 'Hsinchui City', 'Municipality',NULL),
('TW-KEE', 'TW', 'KEE', 'Keelung City', 'Municipality',NULL),
('TW-TXG', 'TW', 'TXG', 'Taichung City', 'Municipality',NULL),
('TW-TNN', 'TW', 'TNN', 'Tainan City', 'Municipality',NULL),
('TW-KHH', 'TW', 'KHH', 'Kaohsiung City', 'Special Municipality',NULL),
('TW-TPE', 'TW', 'TPE', 'Taipei City', 'Special Municipality',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('TJ', 'TJK', 'Tajikistan', '', 'Republic of Tajikistan');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('TJ-GB', 'TJ', 'GB', 'Gorno-Badakhshan', 'Autonomous region',NULL),
('TJ-KT', 'TJ', 'KT', 'Khatlon', 'Region',NULL),
('TJ-SU', 'TJ', 'SU', 'Sughd', 'Region',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('TZ', 'TZA', 'Tanzania, United Republic of', 'Tanzania', 'United Republic of Tanzania');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('TZ-01', 'TZ', '01', 'Arusha', 'Region',NULL),
('TZ-02', 'TZ', '02', 'Dar-es-Salaam', 'Region',NULL),
('TZ-03', 'TZ', '03', 'Dodoma', 'Region',NULL),
('TZ-04', 'TZ', '04', 'Iringa', 'Region',NULL),
('TZ-05', 'TZ', '05', 'Kagera', 'Region',NULL),
('TZ-06', 'TZ', '06', 'Kaskazini Pemba', 'Region',NULL),
('TZ-07', 'TZ', '07', 'Kaskazini Unguja', 'Region',NULL),
('TZ-08', 'TZ', '08', 'Kigoma', 'Region',NULL),
('TZ-09', 'TZ', '09', 'Kilimanjaro', 'Region',NULL),
('TZ-10', 'TZ', '10', 'Kusini Pemba', 'Region',NULL),
('TZ-11', 'TZ', '11', 'Kusini Unguja', 'Region',NULL),
('TZ-12', 'TZ', '12', 'Lindi', 'Region',NULL),
('TZ-26', 'TZ', '26', 'Manyara', 'Region',NULL),
('TZ-13', 'TZ', '13', 'Mara', 'Region',NULL),
('TZ-14', 'TZ', '14', 'Mbeya', 'Region',NULL),
('TZ-15', 'TZ', '15', 'Mjini Magharibi', 'Region',NULL),
('TZ-16', 'TZ', '16', 'Morogoro', 'Region',NULL),
('TZ-17', 'TZ', '17', 'Mtwara', 'Region',NULL),
('TZ-18', 'TZ', '18', 'Mwanza', 'Region',NULL),
('TZ-19', 'TZ', '19', 'Pwani', 'Region',NULL),
('TZ-20', 'TZ', '20', 'Rukwa', 'Region',NULL),
('TZ-21', 'TZ', '21', 'Ruvuma', 'Region',NULL),
('TZ-22', 'TZ', '22', 'Shinyanga', 'Region',NULL),
('TZ-23', 'TZ', '23', 'Singida', 'Region',NULL),
('TZ-24', 'TZ', '24', 'Tabora', 'Region',NULL),
('TZ-25', 'TZ', '25', 'Tanga', 'Region',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('TH', 'THA', 'Thailand', '', 'Kingdom of Thailand');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('TH-10', 'TH', '10', 'Krung Thep Maha Nakhon Bangkok', 'Municipality',NULL),
('TH-S', 'TH', 'S', 'Phatthaya', 'Province',NULL),
('TH-37', 'TH', '37', 'Amnat Charoen', 'Province',NULL),
('TH-15', 'TH', '15', 'Ang Thong', 'Province',NULL),
('TH-31', 'TH', '31', 'Buri Ram', 'Province',NULL),
('TH-24', 'TH', '24', 'Chachoengsao', 'Province',NULL),
('TH-18', 'TH', '18', 'Chai Nat', 'Province',NULL),
('TH-36', 'TH', '36', 'Chaiyaphum', 'Province',NULL),
('TH-22', 'TH', '22', 'Chanthaburi', 'Province',NULL),
('TH-50', 'TH', '50', 'Chiang Mai', 'Province',NULL),
('TH-57', 'TH', '57', 'Chiang Rai', 'Province',NULL),
('TH-20', 'TH', '20', 'Chon Buri', 'Province',NULL),
('TH-86', 'TH', '86', 'Chumphon', 'Province',NULL),
('TH-46', 'TH', '46', 'Kalasin', 'Province',NULL),
('TH-62', 'TH', '62', 'Kamphaeng Phet', 'Province',NULL),
('TH-71', 'TH', '71', 'Kanchanaburi', 'Province',NULL),
('TH-40', 'TH', '40', 'Khon Kaen', 'Province',NULL),
('TH-81', 'TH', '81', 'Krabi', 'Province',NULL),
('TH-52', 'TH', '52', 'Lampang', 'Province',NULL),
('TH-51', 'TH', '51', 'Lamphun', 'Province',NULL),
('TH-42', 'TH', '42', 'Loei', 'Province',NULL),
('TH-16', 'TH', '16', 'Lop Buri', 'Province',NULL),
('TH-58', 'TH', '58', 'Mae Hong Son', 'Province',NULL),
('TH-44', 'TH', '44', 'Maha Sarakham', 'Province',NULL),
('TH-49', 'TH', '49', 'Mukdahan', 'Province',NULL),
('TH-26', 'TH', '26', 'Nakhon Nayok', 'Province',NULL),
('TH-73', 'TH', '73', 'Nakhon Pathom', 'Province',NULL),
('TH-48', 'TH', '48', 'Nakhon Phanom', 'Province',NULL),
('TH-30', 'TH', '30', 'Nakhon Ratchasima', 'Province',NULL),
('TH-60', 'TH', '60', 'Nakhon Sawan', 'Province',NULL),
('TH-80', 'TH', '80', 'Nakhon Si Thammarat', 'Province',NULL),
('TH-55', 'TH', '55', 'Nan', 'Province',NULL),
('TH-96', 'TH', '96', 'Narathiwat', 'Province',NULL),
('TH-39', 'TH', '39', 'Nong Bua Lam Phu', 'Province',NULL),
('TH-43', 'TH', '43', 'Nong Khai', 'Province',NULL),
('TH-12', 'TH', '12', 'Nonthaburi', 'Province',NULL),
('TH-13', 'TH', '13', 'Pathum Thani', 'Province',NULL),
('TH-94', 'TH', '94', 'Pattani', 'Province',NULL),
('TH-82', 'TH', '82', 'Phangnga', 'Province',NULL),
('TH-93', 'TH', '93', 'Phatthalung', 'Province',NULL),
('TH-56', 'TH', '56', 'Phayao', 'Province',NULL),
('TH-67', 'TH', '67', 'Phetchabun', 'Province',NULL),
('TH-76', 'TH', '76', 'Phetchaburi', 'Province',NULL),
('TH-66', 'TH', '66', 'Phichit', 'Province',NULL),
('TH-65', 'TH', '65', 'Phitsanulok', 'Province',NULL),
('TH-54', 'TH', '54', 'Phrae', 'Province',NULL),
('TH-14', 'TH', '14', 'Phra Nakhon Si Ayutthaya', 'Province',NULL),
('TH-83', 'TH', '83', 'Phuket', 'Province',NULL),
('TH-25', 'TH', '25', 'Prachin Buri', 'Province',NULL),
('TH-77', 'TH', '77', 'Prachuap Khiri Khan', 'Province',NULL),
('TH-85', 'TH', '85', 'Ranong', 'Province',NULL),
('TH-70', 'TH', '70', 'Ratchaburi', 'Province',NULL),
('TH-21', 'TH', '21', 'Rayong', 'Province',NULL),
('TH-45', 'TH', '45', 'Roi Et', 'Province',NULL),
('TH-27', 'TH', '27', 'Sa Kaeo', 'Province',NULL),
('TH-47', 'TH', '47', 'Sakon Nakhon', 'Province',NULL),
('TH-11', 'TH', '11', 'Samut Prakan', 'Province',NULL),
('TH-74', 'TH', '74', 'Samut Sakhon', 'Province',NULL),
('TH-75', 'TH', '75', 'Samut Songkhram', 'Province',NULL),
('TH-19', 'TH', '19', 'Saraburi', 'Province',NULL),
('TH-91', 'TH', '91', 'Satun', 'Province',NULL),
('TH-17', 'TH', '17', 'Sing Buri', 'Province',NULL),
('TH-33', 'TH', '33', 'Si Sa Ket', 'Province',NULL),
('TH-90', 'TH', '90', 'Songkhla', 'Province',NULL),
('TH-64', 'TH', '64', 'Sukhothai', 'Province',NULL),
('TH-72', 'TH', '72', 'Suphan Buri', 'Province',NULL),
('TH-84', 'TH', '84', 'Surat Thani', 'Province',NULL),
('TH-32', 'TH', '32', 'Surin', 'Province',NULL),
('TH-63', 'TH', '63', 'Tak', 'Province',NULL),
('TH-92', 'TH', '92', 'Trang', 'Province',NULL),
('TH-23', 'TH', '23', 'Trat', 'Province',NULL),
('TH-34', 'TH', '34', 'Ubon Ratchathani', 'Province',NULL),
('TH-41', 'TH', '41', 'Udon Thani', 'Province',NULL),
('TH-61', 'TH', '61', 'Uthai Thani', 'Province',NULL),
('TH-53', 'TH', '53', 'Uttaradit', 'Province',NULL),
('TH-95', 'TH', '95', 'Yala', 'Province',NULL),
('TH-35', 'TH', '35', 'Yasothon', 'Province',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('TL', 'TLS', 'Timor-Leste', '', 'Democratic Republic of Timor-Leste');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('TL-AL', 'TL', 'AL', 'Aileu', 'District',NULL),
('TL-AN', 'TL', 'AN', 'Ainaro', 'District',NULL),
('TL-BA', 'TL', 'BA', 'Baucau', 'District',NULL),
('TL-BO', 'TL', 'BO', 'Bobonaro', 'District',NULL),
('TL-CO', 'TL', 'CO', 'Cova Lima', 'District',NULL),
('TL-DI', 'TL', 'DI', 'Díli', 'District',NULL),
('TL-ER', 'TL', 'ER', 'Ermera', 'District',NULL),
('TL-LA', 'TL', 'LA', 'Lautem', 'District',NULL),
('TL-LI', 'TL', 'LI', 'Liquiça', 'District',NULL),
('TL-MT', 'TL', 'MT', 'Manatuto', 'District',NULL),
('TL-MF', 'TL', 'MF', 'Manufahi', 'District',NULL),
('TL-OE', 'TL', 'OE', 'Oecussi', 'District',NULL),
('TL-VI', 'TL', 'VI', 'Viqueque', 'District',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('TG', 'TGO', 'Togo', '', 'Togolese Republic');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('TG-C', 'TG', 'C', 'Région du Centre', 'Region',NULL),
('TG-K', 'TG', 'K', 'Région de la Kara', 'Region',NULL),
('TG-M', 'TG', 'M', 'Région Maritime', 'Region',NULL),
('TG-P', 'TG', 'P', 'Région des Plateaux', 'Region',NULL),
('TG-S', 'TG', 'S', 'Région des Savannes', 'Region',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('TK', 'TKL', 'Tokelau', '', '');

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('TO', 'TON', 'Tonga', '', 'Kingdom of Tonga');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('TO-01', 'TO', '01', '''Eua', 'Division',NULL),
('TO-02', 'TO', '02', 'Ha''apai', 'Division',NULL),
('TO-03', 'TO', '03', 'Niuas', 'Division',NULL),
('TO-04', 'TO', '04', 'Tongatapu', 'Division',NULL),
('TO-05', 'TO', '05', 'Vava''u', 'Division',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('TT', 'TTO', 'Trinidad and Tobago', '', 'Republic of Trinidad and Tobago');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('TT-CTT', 'TT', 'CTT', 'Couva-Tabaquite-Talparo', 'Region',NULL),
('TT-DMN', 'TT', 'DMN', 'Diego Martin', 'Region',NULL),
('TT-ETO', 'TT', 'ETO', 'Eastern Tobago', 'Region',NULL),
('TT-PED', 'TT', 'PED', 'Penal-Debe', 'Region',NULL),
('TT-PRT', 'TT', 'PRT', 'Princes Town', 'Region',NULL),
('TT-RCM', 'TT', 'RCM', 'Rio Claro-Mayaro', 'Region',NULL),
('TT-SGE', 'TT', 'SGE', 'Sangre Grande', 'Region',NULL),
('TT-SJL', 'TT', 'SJL', 'San Juan-Laventille', 'Region',NULL),
('TT-SIP', 'TT', 'SIP', 'Siparia', 'Region',NULL),
('TT-TUP', 'TT', 'TUP', 'Tunapuna-Piarco', 'Region',NULL),
('TT-WTO', 'TT', 'WTO', 'Western Tobago', 'Region',NULL),
('TT-ARI', 'TT', 'ARI', 'Arima', 'Borough',NULL),
('TT-CHA', 'TT', 'CHA', 'Chaguanas', 'Borough',NULL),
('TT-PTF', 'TT', 'PTF', 'Point Fortin', 'Borough',NULL),
('TT-POS', 'TT', 'POS', 'Port of Spain', 'City',NULL),
('TT-SFO', 'TT', 'SFO', 'San Fernando', 'City',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('TN', 'TUN', 'Tunisia', '', 'Republic of Tunisia');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('TN-12', 'TN', '12', 'Ariana', 'Governorate',NULL),
('TN-31', 'TN', '31', 'Béja', 'Governorate',NULL),
('TN-13', 'TN', '13', 'Ben Arous', 'Governorate',NULL),
('TN-23', 'TN', '23', 'Bizerte', 'Governorate',NULL),
('TN-81', 'TN', '81', 'Gabès', 'Governorate',NULL),
('TN-71', 'TN', '71', 'Gafsa', 'Governorate',NULL),
('TN-32', 'TN', '32', 'Jendouba', 'Governorate',NULL),
('TN-41', 'TN', '41', 'Kairouan', 'Governorate',NULL),
('TN-42', 'TN', '42', 'Kasserine', 'Governorate',NULL),
('TN-73', 'TN', '73', 'Kebili', 'Governorate',NULL),
('TN-33', 'TN', '33', 'Le Kef', 'Governorate',NULL),
('TN-53', 'TN', '53', 'Mahdia', 'Governorate',NULL),
('TN-14', 'TN', '14', 'La Manouba', 'Governorate',NULL),
('TN-82', 'TN', '82', 'Medenine', 'Governorate',NULL),
('TN-52', 'TN', '52', 'Monastir', 'Governorate',NULL),
('TN-21', 'TN', '21', 'Nabeul', 'Governorate',NULL),
('TN-61', 'TN', '61', 'Sfax', 'Governorate',NULL),
('TN-43', 'TN', '43', 'Sidi Bouzid', 'Governorate',NULL),
('TN-34', 'TN', '34', 'Siliana', 'Governorate',NULL),
('TN-51', 'TN', '51', 'Sousse', 'Governorate',NULL),
('TN-83', 'TN', '83', 'Tataouine', 'Governorate',NULL),
('TN-72', 'TN', '72', 'Tozeur', 'Governorate',NULL),
('TN-11', 'TN', '11', 'Tunis', 'Governorate',NULL),
('TN-22', 'TN', '22', 'Zaghouan', 'Governorate',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('TR', 'TUR', 'Turkey', '', 'Republic of Turkey');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('TR-01', 'TR', '01', 'Adana', 'Province',NULL),
('TR-02', 'TR', '02', 'Adıyaman', 'Province',NULL),
('TR-03', 'TR', '03', 'Afyonkarahisar', 'Province',NULL),
('TR-04', 'TR', '04', 'Ağrı', 'Province',NULL),
('TR-68', 'TR', '68', 'Aksaray', 'Province',NULL),
('TR-05', 'TR', '05', 'Amasya', 'Province',NULL),
('TR-06', 'TR', '06', 'Ankara', 'Province',NULL),
('TR-07', 'TR', '07', 'Antalya', 'Province',NULL),
('TR-75', 'TR', '75', 'Ardahan', 'Province',NULL),
('TR-08', 'TR', '08', 'Artvin', 'Province',NULL),
('TR-09', 'TR', '09', 'Aydın', 'Province',NULL),
('TR-10', 'TR', '10', 'Balıkesir', 'Province',NULL),
('TR-74', 'TR', '74', 'Bartın', 'Province',NULL),
('TR-72', 'TR', '72', 'Batman', 'Province',NULL),
('TR-69', 'TR', '69', 'Bayburt', 'Province',NULL),
('TR-11', 'TR', '11', 'Bilecik', 'Province',NULL),
('TR-12', 'TR', '12', 'Bingöl', 'Province',NULL),
('TR-13', 'TR', '13', 'Bitlis', 'Province',NULL),
('TR-14', 'TR', '14', 'Bolu', 'Province',NULL),
('TR-15', 'TR', '15', 'Burdur', 'Province',NULL),
('TR-16', 'TR', '16', 'Bursa', 'Province',NULL),
('TR-17', 'TR', '17', 'Çanakkale', 'Province',NULL),
('TR-18', 'TR', '18', 'Çankırı', 'Province',NULL),
('TR-19', 'TR', '19', 'Çorum', 'Province',NULL),
('TR-20', 'TR', '20', 'Denizli', 'Province',NULL),
('TR-21', 'TR', '21', 'Diyarbakır', 'Province',NULL),
('TR-81', 'TR', '81', 'Düzce', 'Province',NULL),
('TR-22', 'TR', '22', 'Edirne', 'Province',NULL),
('TR-23', 'TR', '23', 'Elazığ', 'Province',NULL),
('TR-24', 'TR', '24', 'Erzincan', 'Province',NULL),
('TR-25', 'TR', '25', 'Erzurum', 'Province',NULL),
('TR-26', 'TR', '26', 'Eskişehir', 'Province',NULL),
('TR-27', 'TR', '27', 'Gaziantep', 'Province',NULL),
('TR-28', 'TR', '28', 'Giresun', 'Province',NULL),
('TR-29', 'TR', '29', 'Gümüşhane', 'Province',NULL),
('TR-30', 'TR', '30', 'Hakkâri', 'Province',NULL),
('TR-31', 'TR', '31', 'Hatay', 'Province',NULL),
('TR-76', 'TR', '76', 'Iğdır', 'Province',NULL),
('TR-32', 'TR', '32', 'Isparta', 'Province',NULL),
('TR-34', 'TR', '34', 'İstanbul', 'Province',NULL),
('TR-35', 'TR', '35', 'İzmir', 'Province',NULL),
('TR-46', 'TR', '46', 'Kahramanmaraş', 'Province',NULL),
('TR-78', 'TR', '78', 'Karabük', 'Province',NULL),
('TR-70', 'TR', '70', 'Karaman', 'Province',NULL),
('TR-36', 'TR', '36', 'Kars', 'Province',NULL),
('TR-37', 'TR', '37', 'Kastamonu', 'Province',NULL),
('TR-38', 'TR', '38', 'Kayseri', 'Province',NULL),
('TR-71', 'TR', '71', 'Kırıkkale', 'Province',NULL),
('TR-39', 'TR', '39', 'Kırklareli', 'Province',NULL),
('TR-40', 'TR', '40', 'Kırşehir', 'Province',NULL),
('TR-79', 'TR', '79', 'Kilis', 'Province',NULL),
('TR-41', 'TR', '41', 'Kocaeli', 'Province',NULL),
('TR-42', 'TR', '42', 'Konya', 'Province',NULL),
('TR-43', 'TR', '43', 'Kütahya', 'Province',NULL),
('TR-44', 'TR', '44', 'Malatya', 'Province',NULL),
('TR-45', 'TR', '45', 'Manisa', 'Province',NULL),
('TR-47', 'TR', '47', 'Mardin', 'Province',NULL),
('TR-33', 'TR', '33', 'Mersin', 'Province',NULL),
('TR-48', 'TR', '48', 'Muğla', 'Province',NULL),
('TR-49', 'TR', '49', 'Muş', 'Province',NULL),
('TR-50', 'TR', '50', 'Nevşehir', 'Province',NULL),
('TR-51', 'TR', '51', 'Niğde', 'Province',NULL),
('TR-52', 'TR', '52', 'Ordu', 'Province',NULL),
('TR-80', 'TR', '80', 'Osmaniye', 'Province',NULL),
('TR-53', 'TR', '53', 'Rize', 'Province',NULL),
('TR-54', 'TR', '54', 'Sakarya', 'Province',NULL),
('TR-55', 'TR', '55', 'Samsun', 'Province',NULL),
('TR-56', 'TR', '56', 'Siirt', 'Province',NULL),
('TR-57', 'TR', '57', 'Sinop', 'Province',NULL),
('TR-58', 'TR', '58', 'Sivas', 'Province',NULL),
('TR-63', 'TR', '63', 'Şanlıurfa', 'Province',NULL),
('TR-73', 'TR', '73', 'Şırnak', 'Province',NULL),
('TR-59', 'TR', '59', 'Tekirdağ', 'Province',NULL),
('TR-60', 'TR', '60', 'Tokat', 'Province',NULL),
('TR-61', 'TR', '61', 'Trabzon', 'Province',NULL),
('TR-62', 'TR', '62', 'Tunceli', 'Province',NULL),
('TR-64', 'TR', '64', 'Uşak', 'Province',NULL),
('TR-65', 'TR', '65', 'Van', 'Province',NULL),
('TR-77', 'TR', '77', 'Yalova', 'Province',NULL),
('TR-66', 'TR', '66', 'Yozgat', 'Province',NULL),
('TR-67', 'TR', '67', 'Zonguldak', 'Province',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('TM', 'TKM', 'Turkmenistan', '', '');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('TM-A', 'TM', 'A', 'Ahal', 'Region',NULL),
('TM-B', 'TM', 'B', 'Balkan', 'Region',NULL),
('TM-D', 'TM', 'D', 'Daşoguz', 'Region',NULL),
('TM-L', 'TM', 'L', 'Lebap', 'Region',NULL),
('TM-M', 'TM', 'M', 'Mary', 'Region',NULL),
('TM-S', 'TM', 'S', 'Aşgabat', 'City',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('TC', 'TCA', 'Turks and Caicos Islands', '', '');

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('TV', 'TUV', 'Tuvalu', '', '');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('TV-FUN', 'TV', 'FUN', 'Funafuti', 'Town council',NULL),
('TV-NMG', 'TV', 'NMG', 'Nanumanga', 'Island council',NULL),
('TV-NMA', 'TV', 'NMA', 'Nanumea', 'Island council',NULL),
('TV-NIT', 'TV', 'NIT', 'Niutao', 'Island council',NULL),
('TV-NUI', 'TV', 'NUI', 'Nui', 'Island council',NULL),
('TV-NKF', 'TV', 'NKF', 'Nukufetau', 'Island council',NULL),
('TV-NKL', 'TV', 'NKL', 'Nukulaelae', 'Island council',NULL),
('TV-VAI', 'TV', 'VAI', 'Vaitupu', 'Island council',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('UG', 'UGA', 'Uganda', '', 'Republic of Uganda');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('UG-C', 'UG', 'C', 'Central', 'Geographical region',NULL),
('UG-E', 'UG', 'E', 'Eastern', 'Geographical region',NULL),
('UG-N', 'UG', 'N', 'Northern', 'Geographical region',NULL),
('UG-W', 'UG', 'W', 'Western', 'Geographical region',NULL),
('UG-317', 'UG', '317', 'Abim', 'District','UG-N'),
('UG-301', 'UG', '301', 'Adjumani', 'District','UG-N'),
('UG-314', 'UG', '314', 'Amolatar', 'District','UG-N'),
('UG-216', 'UG', '216', 'Amuria', 'District','UG-E'),
('UG-319', 'UG', '319', 'Amuru', 'District','UG-N'),
('UG-302', 'UG', '302', 'Apac', 'District','UG-N'),
('UG-303', 'UG', '303', 'Arua', 'District','UG-N'),
('UG-217', 'UG', '217', 'Budaka', 'District','UG-E'),
('UG-223', 'UG', '223', 'Bududa', 'District','UG-E'),
('UG-201', 'UG', '201', 'Bugiri', 'District','UG-E'),
('UG-224', 'UG', '224', 'Bukedea', 'District','UG-E'),
('UG-218', 'UG', '218', 'Bukwa', 'District','UG-E'),
('UG-419', 'UG', '419', 'Buliisa', 'District','UG-W'),
('UG-401', 'UG', '401', 'Bundibugyo', 'District','UG-W'),
('UG-402', 'UG', '402', 'Bushenyi', 'District','UG-W'),
('UG-202', 'UG', '202', 'Busia', 'District','UG-E'),
('UG-219', 'UG', '219', 'Butaleja', 'District','UG-E'),
('UG-318', 'UG', '318', 'Dokolo', 'District','UG-N'),
('UG-304', 'UG', '304', 'Gulu', 'District','UG-N'),
('UG-403', 'UG', '403', 'Hoima', 'District','UG-W'),
('UG-416', 'UG', '416', 'Ibanda', 'District','UG-W'),
('UG-203', 'UG', '203', 'Iganga', 'District','UG-E'),
('UG-417', 'UG', '417', 'Isingiro', 'District','UG-W'),
('UG-204', 'UG', '204', 'Jinja', 'District','UG-E'),
('UG-315', 'UG', '315', 'Kaabong', 'District','UG-N'),
('UG-404', 'UG', '404', 'Kabale', 'District','UG-W'),
('UG-405', 'UG', '405', 'Kabarole', 'District','UG-W'),
('UG-213', 'UG', '213', 'Kaberamaido', 'District','UG-E'),
('UG-101', 'UG', '101', 'Kalangala', 'District','UG-C'),
('UG-220', 'UG', '220', 'Kaliro', 'District','UG-E'),
('UG-102', 'UG', '102', 'Kampala', 'District','UG-C'),
('UG-205', 'UG', '205', 'Kamuli', 'District','UG-E'),
('UG-413', 'UG', '413', 'Kamwenge', 'District','UG-W'),
('UG-414', 'UG', '414', 'Kanungu', 'District','UG-W'),
('UG-206', 'UG', '206', 'Kapchorwa', 'District','UG-E'),
('UG-406', 'UG', '406', 'Kasese', 'District','UG-W'),
('UG-207', 'UG', '207', 'Katakwi', 'District','UG-E'),
('UG-112', 'UG', '112', 'Kayunga', 'District','UG-C'),
('UG-407', 'UG', '407', 'Kibaale', 'District','UG-W'),
('UG-103', 'UG', '103', 'Kiboga', 'District','UG-C'),
('UG-418', 'UG', '418', 'Kiruhura', 'District','UG-W'),
('UG-408', 'UG', '408', 'Kisoro', 'District','UG-W'),
('UG-305', 'UG', '305', 'Kitgum', 'District','UG-N'),
('UG-316', 'UG', '316', 'Koboko', 'District','UG-N'),
('UG-306', 'UG', '306', 'Kotido', 'District','UG-N'),
('UG-208', 'UG', '208', 'Kumi', 'District','UG-E'),
('UG-415', 'UG', '415', 'Kyenjojo', 'District','UG-W'),
('UG-307', 'UG', '307', 'Lira', 'District','UG-N'),
('UG-104', 'UG', '104', 'Luwero', 'District','UG-C'),
('UG-116', 'UG', '116', 'Lyantonde', 'District','UG-C'),
('UG-221', 'UG', '221', 'Manafwa', 'District','UG-E'),
('UG-320', 'UG', '320', 'Maracha', 'District','UG-N'),
('UG-105', 'UG', '105', 'Masaka', 'District','UG-C'),
('UG-409', 'UG', '409', 'Masindi', 'District','UG-W'),
('UG-214', 'UG', '214', 'Mayuge', 'District','UG-E'),
('UG-209', 'UG', '209', 'Mbale', 'District','UG-E'),
('UG-410', 'UG', '410', 'Mbarara', 'District','UG-W'),
('UG-114', 'UG', '114', 'Mityana', 'District','UG-C'),
('UG-308', 'UG', '308', 'Moroto', 'District','UG-N'),
('UG-309', 'UG', '309', 'Moyo', 'District','UG-N'),
('UG-106', 'UG', '106', 'Mpigi', 'District','UG-C'),
('UG-107', 'UG', '107', 'Mubende', 'District','UG-C'),
('UG-108', 'UG', '108', 'Mukono', 'District','UG-C'),
('UG-311', 'UG', '311', 'Nakapiripirit', 'District','UG-N'),
('UG-115', 'UG', '115', 'Nakaseke', 'District','UG-C'),
('UG-109', 'UG', '109', 'Nakasongola', 'District','UG-C'),
('UG-222', 'UG', '222', 'Namutumba', 'District','UG-E'),
('UG-310', 'UG', '310', 'Nebbi', 'District','UG-N'),
('UG-411', 'UG', '411', 'Ntungamo', 'District','UG-W'),
('UG-321', 'UG', '321', 'Oyam', 'District','UG-N'),
('UG-312', 'UG', '312', 'Pader', 'District','UG-N'),
('UG-210', 'UG', '210', 'Pallisa', 'District','UG-E'),
('UG-110', 'UG', '110', 'Rakai', 'District','UG-C'),
('UG-412', 'UG', '412', 'Rukungiri', 'District','UG-W'),
('UG-111', 'UG', '111', 'Sembabule', 'District','UG-C'),
('UG-215', 'UG', '215', 'Sironko', 'District','UG-E'),
('UG-211', 'UG', '211', 'Soroti', 'District','UG-E'),
('UG-212', 'UG', '212', 'Tororo', 'District','UG-E'),
('UG-113', 'UG', '113', 'Wakiso', 'District','UG-C'),
('UG-313', 'UG', '313', 'Yumbe', 'District','UG-N');

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('UA', 'UKR', 'Ukraine', '', '');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('UA-71', 'UA', '71', 'Cherkas''ka Oblast''', 'Province',NULL),
('UA-74', 'UA', '74', 'Chernihivs''ka Oblast''', 'Province',NULL),
('UA-77', 'UA', '77', 'Chernivets''ka Oblast''', 'Province',NULL),
('UA-12', 'UA', '12', 'Dnipropetrovs''ka Oblast''', 'Province',NULL),
('UA-14', 'UA', '14', 'Donets''ka Oblast''', 'Province',NULL),
('UA-26', 'UA', '26', 'Ivano-Frankivs''ka Oblast''', 'Province',NULL),
('UA-63', 'UA', '63', 'Kharkivs''ka Oblast''', 'Province',NULL),
('UA-65', 'UA', '65', 'Khersons''ka Oblast''', 'Province',NULL),
('UA-68', 'UA', '68', 'Khmel''nyts''ka Oblast''', 'Province',NULL),
('UA-35', 'UA', '35', 'Kirovohrads''ka Oblast''', 'Province',NULL),
('UA-32', 'UA', '32', 'Kyïvs''ka Oblast''', 'Province',NULL),
('UA-09', 'UA', '09', 'Luhans''ka Oblast''', 'Province',NULL),
('UA-46', 'UA', '46', 'L''vivs''ka Oblast''', 'Province',NULL),
('UA-48', 'UA', '48', 'Mykolaïvs''ka Oblast''', 'Province',NULL),
('UA-51', 'UA', '51', 'Odes''ka Oblast''', 'Province',NULL),
('UA-53', 'UA', '53', 'Poltavs''ka Oblast''', 'Province',NULL),
('UA-56', 'UA', '56', 'Rivnens''ka Oblast''', 'Province',NULL),
('UA-59', 'UA', '59', 'Sums ''ka Oblast''', 'Province',NULL),
('UA-61', 'UA', '61', 'Ternopil''s''ka Oblast''', 'Province',NULL),
('UA-05', 'UA', '05', 'Vinnyts''ka Oblast''', 'Province',NULL),
('UA-07', 'UA', '07', 'Volyns''ka Oblast''', 'Province',NULL),
('UA-21', 'UA', '21', 'Zakarpats''ka Oblast''', 'Province',NULL),
('UA-23', 'UA', '23', 'Zaporiz''ka Oblast''', 'Province',NULL),
('UA-18', 'UA', '18', 'Zhytomyrs''ka Oblast''', 'Province',NULL),
('UA-43', 'UA', '43', 'Respublika Krym', 'Autonomous republic',NULL),
('UA-30', 'UA', '30', 'Kyïvs''ka mis''ka rada', 'City',NULL),
('UA-40', 'UA', '40', 'Sevastopol', 'City',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('AE', 'ARE', 'United Arab Emirates', '', '');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('AE-AZ', 'AE', 'AZ', 'Abū Ȥaby [Abu Dhabi]', 'Emirate',NULL),
('AE-AJ', 'AE', 'AJ', '''Ajmān', 'Emirate',NULL),
('AE-FU', 'AE', 'FU', 'Al Fujayrah', 'Emirate',NULL),
('AE-SH', 'AE', 'SH', 'Ash Shāriqah', 'Emirate',NULL),
('AE-DU', 'AE', 'DU', 'Dubayy', 'Emirate',NULL),
('AE-RK', 'AE', 'RK', 'Ra’s al Khaymah', 'Emirate',NULL),
('AE-UQ', 'AE', 'UQ', 'Umm al Qaywayn', 'Emirate',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('GB', 'GBR', 'United Kingdom', '', 'United Kingdom of Great Britain and Northern Ireland');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('GB-ENG', 'GB', 'ENG', 'England', 'Country',NULL),
('GB-SCT', 'GB', 'SCT', 'Scotland', 'Country',NULL),
('GB-WLS', 'GB', 'WLS', 'Wales', 'Country',NULL),
('GB-NIR', 'GB', 'NIR', 'Northern Ireland', 'Province',NULL),
('GB-EAW', 'GB', 'EAW', 'England and Wales', 'Included for completeness',NULL),
('GB-GBN', 'GB', 'GBN', 'Great Britain', 'Included for completeness',NULL),
('GB-UKM', 'GB', 'UKM', 'United Kingdom', 'Included for completeness',NULL),
('GB-BKM', 'GB', 'BKM', 'Buckinghamshire', 'Two-tier county',NULL),
('GB-CAM', 'GB', 'CAM', 'Cambridgeshire', 'Two-tier county',NULL),
('GB-CMA', 'GB', 'CMA', 'Cumbria', 'Two-tier county',NULL),
('GB-DBY', 'GB', 'DBY', 'Derbyshire', 'Two-tier county',NULL),
('GB-DEV', 'GB', 'DEV', 'Devon', 'Two-tier county',NULL),
('GB-DOR', 'GB', 'DOR', 'Dorset', 'Two-tier county',NULL),
('GB-ESX', 'GB', 'ESX', 'East Sussex', 'Two-tier county',NULL),
('GB-ESS', 'GB', 'ESS', 'Essex', 'Two-tier county',NULL),
('GB-GLS', 'GB', 'GLS', 'Gloucestershire', 'Two-tier county',NULL),
('GB-HAM', 'GB', 'HAM', 'Hampshire', 'Two-tier county',NULL),
('GB-HRT', 'GB', 'HRT', 'Hertfordshire', 'Two-tier county',NULL),
('GB-KEN', 'GB', 'KEN', 'Kent', 'Two-tier county',NULL),
('GB-LAN', 'GB', 'LAN', 'Lancashire', 'Two-tier county',NULL),
('GB-LEC', 'GB', 'LEC', 'Leicestershire', 'Two-tier county',NULL),
('GB-LIN', 'GB', 'LIN', 'Lincolnshire', 'Two-tier county',NULL),
('GB-NFK', 'GB', 'NFK', 'Norfolk', 'Two-tier county',NULL),
('GB-NYK', 'GB', 'NYK', 'North Yorkshire', 'Two-tier county',NULL),
('GB-NTH', 'GB', 'NTH', 'Northamptonshire', 'Two-tier county',NULL),
('GB-NTT', 'GB', 'NTT', 'Nottinghamshire', 'Two-tier county',NULL),
('GB-OXF', 'GB', 'OXF', 'Oxfordshire', 'Two-tier county',NULL),
('GB-SOM', 'GB', 'SOM', 'Somerset', 'Two-tier county',NULL),
('GB-STS', 'GB', 'STS', 'Staffordshire', 'Two-tier county',NULL),
('GB-SFK', 'GB', 'SFK', 'Suffolk', 'Two-tier county',NULL),
('GB-SRY', 'GB', 'SRY', 'Surrey', 'Two-tier county',NULL),
('GB-WAR', 'GB', 'WAR', 'Warwickshire', 'Two-tier county',NULL),
('GB-WSX', 'GB', 'WSX', 'West Sussex', 'Two-tier county',NULL),
('GB-WOR', 'GB', 'WOR', 'Worcestershire', 'Two-tier county',NULL),
('GB-BDG', 'GB', 'BDG', 'Barking and Dagenham', 'London borough',NULL),
('GB-BNE', 'GB', 'BNE', 'Barnet', 'London borough',NULL),
('GB-BEX', 'GB', 'BEX', 'Bexley', 'London borough',NULL),
('GB-BEN', 'GB', 'BEN', 'Brent', 'London borough',NULL),
('GB-BRY', 'GB', 'BRY', 'Bromley', 'London borough',NULL),
('GB-CMD', 'GB', 'CMD', 'Camden', 'London borough',NULL),
('GB-CRY', 'GB', 'CRY', 'Croydon', 'London borough',NULL),
('GB-EAL', 'GB', 'EAL', 'Ealing', 'London borough',NULL),
('GB-ENF', 'GB', 'ENF', 'Enfield', 'London borough',NULL),
('GB-GRE', 'GB', 'GRE', 'Greenwich', 'London borough',NULL),
('GB-HCK', 'GB', 'HCK', 'Hackney', 'London borough',NULL),
('GB-HMF', 'GB', 'HMF', 'Hammersmith and Fulham', 'London borough',NULL),
('GB-HRY', 'GB', 'HRY', 'Haringey', 'London borough',NULL),
('GB-HRW', 'GB', 'HRW', 'Harrow', 'London borough',NULL),
('GB-HAV', 'GB', 'HAV', 'Havering', 'London borough',NULL),
('GB-HIL', 'GB', 'HIL', 'Hillingdon', 'London borough',NULL),
('GB-HNS', 'GB', 'HNS', 'Hounslow', 'London borough',NULL),
('GB-ISL', 'GB', 'ISL', 'Islington', 'London borough',NULL),
('GB-KEC', 'GB', 'KEC', 'Kensington and Chelsea', 'London borough',NULL),
('GB-KTT', 'GB', 'KTT', 'Kingston upon Thames', 'London borough',NULL),
('GB-LBH', 'GB', 'LBH', 'Lambeth', 'London borough',NULL),
('GB-LEW', 'GB', 'LEW', 'Lewisham', 'London borough',NULL),
('GB-MRT', 'GB', 'MRT', 'Merton', 'London borough',NULL),
('GB-NWM', 'GB', 'NWM', 'Newham', 'London borough',NULL),
('GB-RDB', 'GB', 'RDB', 'Redbridge', 'London borough',NULL),
('GB-RIC', 'GB', 'RIC', 'Richmond upon Thames', 'London borough',NULL),
('GB-SWK', 'GB', 'SWK', 'Southwark', 'London borough',NULL),
('GB-STN', 'GB', 'STN', 'Sutton', 'London borough',NULL),
('GB-TWH', 'GB', 'TWH', 'Tower Hamlets', 'London borough',NULL),
('GB-WFT', 'GB', 'WFT', 'Waltham Forest', 'London borough',NULL),
('GB-WND', 'GB', 'WND', 'Wandsworth', 'London borough',NULL),
('GB-WSM', 'GB', 'WSM', 'Westminster', 'London borough',NULL),
('GB-BNS', 'GB', 'BNS', 'Barnsley', 'Metropolitan district',NULL),
('GB-BIR', 'GB', 'BIR', 'Birmingham', 'Metropolitan district',NULL),
('GB-BOL', 'GB', 'BOL', 'Bolton', 'Metropolitan district',NULL),
('GB-BRD', 'GB', 'BRD', 'Bradford', 'Metropolitan district',NULL),
('GB-BUR', 'GB', 'BUR', 'Bury', 'Metropolitan district',NULL),
('GB-CLD', 'GB', 'CLD', 'Calderdale', 'Metropolitan district',NULL),
('GB-COV', 'GB', 'COV', 'Coventry', 'Metropolitan district',NULL),
('GB-DNC', 'GB', 'DNC', 'Doncaster', 'Metropolitan district',NULL),
('GB-DUD', 'GB', 'DUD', 'Dudley', 'Metropolitan district',NULL),
('GB-GAT', 'GB', 'GAT', 'Gateshead', 'Metropolitan district',NULL),
('GB-KIR', 'GB', 'KIR', 'Kirklees', 'Metropolitan district',NULL),
('GB-KWL', 'GB', 'KWL', 'Knowsley', 'Metropolitan district',NULL),
('GB-LDS', 'GB', 'LDS', 'Leeds', 'Metropolitan district',NULL),
('GB-LIV', 'GB', 'LIV', 'Liverpool', 'Metropolitan district',NULL),
('GB-MAN', 'GB', 'MAN', 'Manchester', 'Metropolitan district',NULL),
('GB-NET', 'GB', 'NET', 'Newcastle upon Tyne', 'Metropolitan district',NULL),
('GB-NTY', 'GB', 'NTY', 'North Tyneside', 'Metropolitan district',NULL),
('GB-OLD', 'GB', 'OLD', 'Oldham', 'Metropolitan district',NULL),
('GB-RCH', 'GB', 'RCH', 'Rochdale', 'Metropolitan district',NULL),
('GB-ROT', 'GB', 'ROT', 'Rotherham', 'Metropolitan district',NULL),
('GB-SHN', 'GB', 'SHN', 'St. Helens', 'Metropolitan district',NULL),
('GB-SLF', 'GB', 'SLF', 'Salford', 'Metropolitan district',NULL),
('GB-SAW', 'GB', 'SAW', 'Sandwell', 'Metropolitan district',NULL),
('GB-SFT', 'GB', 'SFT', 'Sefton', 'Metropolitan district',NULL),
('GB-SHF', 'GB', 'SHF', 'Sheffield', 'Metropolitan district',NULL),
('GB-SOL', 'GB', 'SOL', 'Solihull', 'Metropolitan district',NULL),
('GB-STY', 'GB', 'STY', 'South Tyneside', 'Metropolitan district',NULL),
('GB-SKP', 'GB', 'SKP', 'Stockport', 'Metropolitan district',NULL),
('GB-SND', 'GB', 'SND', 'Sunderland', 'Metropolitan district',NULL),
('GB-TAM', 'GB', 'TAM', 'Tameside', 'Metropolitan district',NULL),
('GB-TRF', 'GB', 'TRF', 'Trafford', 'Metropolitan district',NULL),
('GB-WKF', 'GB', 'WKF', 'Wakefield', 'Metropolitan district',NULL),
('GB-WLL', 'GB', 'WLL', 'Walsall', 'Metropolitan district',NULL),
('GB-WGN', 'GB', 'WGN', 'Wigan', 'Metropolitan district',NULL),
('GB-WRL', 'GB', 'WRL', 'Wirral', 'Metropolitan district',NULL),
('GB-WLV', 'GB', 'WLV', 'Wolverhampton', 'Metropolitan district',NULL),
('GB-LND', 'GB', 'LND', 'London, City of', 'City corporation',NULL),
('GB-ABE', 'GB', 'ABE', 'Aberdeen City', 'Council area',NULL),
('GB-ABD', 'GB', 'ABD', 'Aberdeenshire', 'Council area',NULL),
('GB-ANS', 'GB', 'ANS', 'Angus', 'Council area',NULL),
('GB-AGB', 'GB', 'AGB', 'Argyll and Bute', 'Council area',NULL),
('GB-CLK', 'GB', 'CLK', 'Clackmannanshire', 'Council area',NULL),
('GB-DGY', 'GB', 'DGY', 'Dumfries and Galloway', 'Council area',NULL),
('GB-DND', 'GB', 'DND', 'Dundee City', 'Council area',NULL),
('GB-EAY', 'GB', 'EAY', 'East Ayrshire', 'Council area',NULL),
('GB-EDU', 'GB', 'EDU', 'East Dunbartonshire', 'Council area',NULL),
('GB-ELN', 'GB', 'ELN', 'East Lothian', 'Council area',NULL),
('GB-ERW', 'GB', 'ERW', 'East Renfrewshire', 'Council area',NULL),
('GB-EDH', 'GB', 'EDH', 'Edinburgh, City of', 'Council area',NULL),
('GB-ELS', 'GB', 'ELS', 'Eilean Siar', 'Council area',NULL),
('GB-FAL', 'GB', 'FAL', 'Falkirk', 'Council area',NULL),
('GB-FIF', 'GB', 'FIF', 'Fife', 'Council area',NULL),
('GB-GLG', 'GB', 'GLG', 'Glasgow City', 'Council area',NULL),
('GB-HLD', 'GB', 'HLD', 'Highland', 'Council area',NULL),
('GB-IVC', 'GB', 'IVC', 'Inverclyde', 'Council area',NULL),
('GB-MLN', 'GB', 'MLN', 'Midlothian', 'Council area',NULL),
('GB-MRY', 'GB', 'MRY', 'Moray', 'Council area',NULL),
('GB-NAY', 'GB', 'NAY', 'North Ayrshire', 'Council area',NULL),
('GB-NLK', 'GB', 'NLK', 'North Lanarkshire', 'Council area',NULL),
('GB-ORK', 'GB', 'ORK', 'Orkney Islands', 'Council area',NULL),
('GB-PKN', 'GB', 'PKN', 'Perth and Kinross', 'Council area',NULL),
('GB-RFW', 'GB', 'RFW', 'Renfrewshire', 'Council area',NULL),
('GB-SCB', 'GB', 'SCB', 'Scottish Borders, The', 'Council area',NULL),
('GB-ZET', 'GB', 'ZET', 'Shetland Islands', 'Council area',NULL),
('GB-SAY', 'GB', 'SAY', 'South Ayrshire', 'Council area',NULL),
('GB-SLK', 'GB', 'SLK', 'South Lanarkshire', 'Council area',NULL),
('GB-STG', 'GB', 'STG', 'Stirling', 'Council area',NULL),
('GB-WDU', 'GB', 'WDU', 'West Dunbartonshire', 'Council area',NULL),
('GB-WLN', 'GB', 'WLN', 'West Lothian', 'Council area',NULL),
('GB-ANT', 'GB', 'ANT', 'Antrim', 'District council area',NULL),
('GB-ARD', 'GB', 'ARD', 'Ards', 'District council area',NULL),
('GB-ARM', 'GB', 'ARM', 'Armagh', 'District council area',NULL),
('GB-BLA', 'GB', 'BLA', 'Ballymena', 'District council area',NULL),
('GB-BLY', 'GB', 'BLY', 'Ballymoney', 'District council area',NULL),
('GB-BNB', 'GB', 'BNB', 'Banbridge', 'District council area',NULL),
('GB-BFS', 'GB', 'BFS', 'Belfast', 'District council area',NULL),
('GB-CKF', 'GB', 'CKF', 'Carrickfergus', 'District council area',NULL),
('GB-CSR', 'GB', 'CSR', 'Castlereagh', 'District council area',NULL),
('GB-CLR', 'GB', 'CLR', 'Coleraine', 'District council area',NULL),
('GB-CKT', 'GB', 'CKT', 'Cookstown', 'District council area',NULL),
('GB-CGV', 'GB', 'CGV', 'Craigavon', 'District council area',NULL),
('GB-DRY', 'GB', 'DRY', 'Derry', 'District council area',NULL),
('GB-DOW', 'GB', 'DOW', 'Down', 'District council area',NULL),
('GB-DGN', 'GB', 'DGN', 'Dungannon and South Tyrone', 'District council area',NULL),
('GB-FER', 'GB', 'FER', 'Fermanagh', 'District council area',NULL),
('GB-LRN', 'GB', 'LRN', 'Larne', 'District council area',NULL),
('GB-LMV', 'GB', 'LMV', 'Limavady', 'District council area',NULL),
('GB-LSB', 'GB', 'LSB', 'Lisburn', 'District council area',NULL),
('GB-MFT', 'GB', 'MFT', 'Magherafelt', 'District council area',NULL),
('GB-MYL', 'GB', 'MYL', 'Moyle', 'District council area',NULL),
('GB-NYM', 'GB', 'NYM', 'Newry and Mourne', 'District council area',NULL),
('GB-NTA', 'GB', 'NTA', 'Newtownabbey', 'District council area',NULL),
('GB-NDN', 'GB', 'NDN', 'North Down', 'District council area',NULL),
('GB-OMH', 'GB', 'OMH', 'Omagh', 'District council area',NULL),
('GB-STB', 'GB', 'STB', 'Strabane', 'District council area',NULL),
('GB-BAS', 'GB', 'BAS', 'Bath and North East Somerset', 'Unitary authority (England)',NULL),
('GB-BBD', 'GB', 'BBD', 'Blackburn with Darwen', 'Unitary authority (England)',NULL),
('GB-BDF', 'GB', 'BDF', 'Bedford', 'Unitary authority (England)',NULL),
('GB-BPL', 'GB', 'BPL', 'Blackpool', 'Unitary authority (England)',NULL),
('GB-BMH', 'GB', 'BMH', 'Bournemouth', 'Unitary authority (England)',NULL),
('GB-BRC', 'GB', 'BRC', 'Bracknell Forest', 'Unitary authority (England)',NULL),
('GB-BNH', 'GB', 'BNH', 'Brighton and Hove', 'Unitary authority (England)',NULL),
('GB-BST', 'GB', 'BST', 'Bristol, City of', 'Unitary authority (England)',NULL),
('GB-CBF', 'GB', 'CBF', 'Central Bedfordshire', 'Unitary authority (England)',NULL),
('GB-CHE', 'GB', 'CHE', 'Cheshire East', 'Unitary authority (England)',NULL),
('GB-CHW', 'GB', 'CHW', 'Cheshire West and Chester', 'Unitary authority (England)',NULL),
('GB-CON', 'GB', 'CON', 'Cornwall', 'Unitary authority (England)',NULL),
('GB-DAL', 'GB', 'DAL', 'Darlington', 'Unitary authority (England)',NULL),
('GB-DER', 'GB', 'DER', 'Derby', 'Unitary authority (England)',NULL),
('GB-DUR', 'GB', 'DUR', 'Durham, County', 'Unitary authority (England)',NULL),
('GB-ERY', 'GB', 'ERY', 'East Riding of Yorkshire', 'Unitary authority (England)',NULL),
('GB-HAL', 'GB', 'HAL', 'Halton', 'Unitary authority (England)',NULL),
('GB-HPL', 'GB', 'HPL', 'Hartlepool', 'Unitary authority (England)',NULL),
('GB-HEF', 'GB', 'HEF', 'Herefordshire', 'Unitary authority (England)',NULL),
('GB-IOW', 'GB', 'IOW', 'Isle of Wight', 'Unitary authority (England)',NULL),
('GB-KHL', 'GB', 'KHL', 'Kingston upon Hull', 'Unitary authority (England)',NULL),
('GB-LCE', 'GB', 'LCE', 'Leicester', 'Unitary authority (England)',NULL),
('GB-LUT', 'GB', 'LUT', 'Luton', 'Unitary authority (England)',NULL),
('GB-MDW', 'GB', 'MDW', 'Medway', 'Unitary authority (England)',NULL),
('GB-MDB', 'GB', 'MDB', 'Middlesbrough', 'Unitary authority (England)',NULL),
('GB-MIK', 'GB', 'MIK', 'Milton Keynes', 'Unitary authority (England)',NULL),
('GB-NEL', 'GB', 'NEL', 'North East Lincolnshire', 'Unitary authority (England)',NULL),
('GB-NLN', 'GB', 'NLN', 'North Lincolnshire', 'Unitary authority (England)',NULL),
('GB-NSM', 'GB', 'NSM', 'North Somerset', 'Unitary authority (England)',NULL),
('GB-NBL', 'GB', 'NBL', 'Northumberland', 'Unitary authority (England)',NULL),
('GB-NGM', 'GB', 'NGM', 'Nottingham', 'Unitary authority (England)',NULL),
('GB-PTE', 'GB', 'PTE', 'Peterborough', 'Unitary authority (England)',NULL),
('GB-PLY', 'GB', 'PLY', 'Plymouth', 'Unitary authority (England)',NULL),
('GB-POL', 'GB', 'POL', 'Poole', 'Unitary authority (England)',NULL),
('GB-POR', 'GB', 'POR', 'Portsmouth', 'Unitary authority (England)',NULL),
('GB-RDG', 'GB', 'RDG', 'Reading', 'Unitary authority (England)',NULL),
('GB-RCC', 'GB', 'RCC', 'Redcar and Cleveland', 'Unitary authority (England)',NULL),
('GB-RUT', 'GB', 'RUT', 'Rutland', 'Unitary authority (England)',NULL),
('GB-SHR', 'GB', 'SHR', 'Shropshire', 'Unitary authority (England)',NULL),
('GB-SLG', 'GB', 'SLG', 'Slough', 'Unitary authority (England)',NULL),
('GB-SGC', 'GB', 'SGC', 'South Gloucestershire', 'Unitary authority (England)',NULL),
('GB-STH', 'GB', 'STH', 'Southampton', 'Unitary authority (England)',NULL),
('GB-SOS', 'GB', 'SOS', 'Southend-on-Sea', 'Unitary authority (England)',NULL),
('GB-STT', 'GB', 'STT', 'Stockton-on-Tees', 'Unitary authority (England)',NULL),
('GB-STE', 'GB', 'STE', 'Stoke-on-Trent', 'Unitary authority (England)',NULL),
('GB-SWD', 'GB', 'SWD', 'Swindon', 'Unitary authority (England)',NULL),
('GB-TFW', 'GB', 'TFW', 'Telford and Wrekin', 'Unitary authority (England)',NULL),
('GB-THR', 'GB', 'THR', 'Thurrock', 'Unitary authority (England)',NULL),
('GB-TOB', 'GB', 'TOB', 'Torbay', 'Unitary authority (England)',NULL),
('GB-WRT', 'GB', 'WRT', 'Warrington', 'Unitary authority (England)',NULL),
('GB-WBK', 'GB', 'WBK', 'West Berkshire', 'Unitary authority (England)',NULL),
('GB-WNM', 'GB', 'WNM', 'Windsor and Maidenhead', 'Unitary authority (England)',NULL),
('GB-WOK', 'GB', 'WOK', 'Wokingham', 'Unitary authority (England)',NULL),
('GB-YOR', 'GB', 'YOR', 'York', 'Unitary authority (England)',NULL),
('GB-BGW', 'GB', 'BGW', 'Blaenau Gwent', 'Unitary authority (Wales)',NULL),
('GB-BGE', 'GB', 'BGE', 'Bridgend;Pen-y-bont ar Ogwr', 'Unitary authority (Wales)',NULL),
('GB-CAY', 'GB', 'CAY', 'Caerphilly;Caerffili', 'Unitary authority (Wales)',NULL),
('GB-CRF', 'GB', 'CRF', 'Cardiff;Caerdydd', 'Unitary authority (Wales)',NULL),
('GB-CMN', 'GB', 'CMN', 'Carmarthenshire;Sir Gaerfyrddin', 'Unitary authority (Wales)',NULL),
('GB-CGN', 'GB', 'CGN', 'Ceredigion;Sir Ceredigion', 'Unitary authority (Wales)',NULL),
('GB-CWY', 'GB', 'CWY', 'Conwy', 'Unitary authority (Wales)',NULL),
('GB-DEN', 'GB', 'DEN', 'Denbighshire;Sir Ddinbych', 'Unitary authority (Wales)',NULL),
('GB-FLN', 'GB', 'FLN', 'Flintshire;Sir y Fflint', 'Unitary authority (Wales)',NULL),
('GB-GWN', 'GB', 'GWN', 'Gwynedd', 'Unitary authority (Wales)',NULL),
('GB-AGY', 'GB', 'AGY', 'Isle of Anglesey;Sir Ynys Môn', 'Unitary authority (Wales)',NULL),
('GB-MTY', 'GB', 'MTY', 'Merthyr Tydfil;Merthyr Tudful', 'Unitary authority (Wales)',NULL),
('GB-MON', 'GB', 'MON', 'Monmouthshire;Sir Fynwy', 'Unitary authority (Wales)',NULL),
('GB-NTL', 'GB', 'NTL', 'Neath Port Talbot;Castell-nedd Port Talbot', 'Unitary authority (Wales)',NULL),
('GB-NWP', 'GB', 'NWP', 'Newport;Casnewydd', 'Unitary authority (Wales)',NULL),
('GB-PEM', 'GB', 'PEM', 'Pembrokeshire;Sir Benfro', 'Unitary authority (Wales)',NULL),
('GB-POW', 'GB', 'POW', 'Powys', 'Unitary authority (Wales)',NULL),
('GB-RCT', 'GB', 'RCT', 'Rhondda, Cynon, Taff;Rhondda, Cynon,Taf', 'Unitary authority (Wales)',NULL),
('GB-SWA', 'GB', 'SWA', 'Swansea;Abertawe', 'Unitary authority (Wales)',NULL),
('GB-TOF', 'GB', 'TOF', 'Torfaen;Tor-faen', 'Unitary authority (Wales)',NULL),
('GB-VGL', 'GB', 'VGL', 'Vale of Glamorgan, The;Bro Morgannwg', 'Unitary authority (Wales)',NULL),
('GB-WRX', 'GB', 'WRX', 'Wrexham;Wrecsam', 'Unitary authority (Wales)',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('US', 'USA', 'United States', '', 'United States of America');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('US-AL', 'US', 'AL', 'Alabama', 'State',NULL),
('US-AK', 'US', 'AK', 'Alaska', 'State',NULL),
('US-AZ', 'US', 'AZ', 'Arizona', 'State',NULL),
('US-AR', 'US', 'AR', 'Arkansas', 'State',NULL),
('US-CA', 'US', 'CA', 'California', 'State',NULL),
('US-CO', 'US', 'CO', 'Colorado', 'State',NULL),
('US-CT', 'US', 'CT', 'Connecticut', 'State',NULL),
('US-DE', 'US', 'DE', 'Delaware', 'State',NULL),
('US-FL', 'US', 'FL', 'Florida', 'State',NULL),
('US-GA', 'US', 'GA', 'Georgia', 'State',NULL),
('US-HI', 'US', 'HI', 'Hawaii', 'State',NULL),
('US-ID', 'US', 'ID', 'Idaho', 'State',NULL),
('US-IL', 'US', 'IL', 'Illinois', 'State',NULL),
('US-IN', 'US', 'IN', 'Indiana', 'State',NULL),
('US-IA', 'US', 'IA', 'Iowa', 'State',NULL),
('US-KS', 'US', 'KS', 'Kansas', 'State',NULL),
('US-KY', 'US', 'KY', 'Kentucky', 'State',NULL),
('US-LA', 'US', 'LA', 'Louisiana', 'State',NULL),
('US-ME', 'US', 'ME', 'Maine', 'State',NULL),
('US-MD', 'US', 'MD', 'Maryland', 'State',NULL),
('US-MA', 'US', 'MA', 'Massachusetts', 'State',NULL),
('US-MI', 'US', 'MI', 'Michigan', 'State',NULL),
('US-MN', 'US', 'MN', 'Minnesota', 'State',NULL),
('US-MS', 'US', 'MS', 'Mississippi', 'State',NULL),
('US-MO', 'US', 'MO', 'Missouri', 'State',NULL),
('US-MT', 'US', 'MT', 'Montana', 'State',NULL),
('US-NE', 'US', 'NE', 'Nebraska', 'State',NULL),
('US-NV', 'US', 'NV', 'Nevada', 'State',NULL),
('US-NH', 'US', 'NH', 'New Hampshire', 'State',NULL),
('US-NJ', 'US', 'NJ', 'New Jersey', 'State',NULL),
('US-NM', 'US', 'NM', 'New Mexico', 'State',NULL),
('US-NY', 'US', 'NY', 'New York', 'State',NULL),
('US-NC', 'US', 'NC', 'North Carolina', 'State',NULL),
('US-ND', 'US', 'ND', 'North Dakota', 'State',NULL),
('US-OH', 'US', 'OH', 'Ohio', 'State',NULL),
('US-OK', 'US', 'OK', 'Oklahoma', 'State',NULL),
('US-OR', 'US', 'OR', 'Oregon', 'State',NULL),
('US-PA', 'US', 'PA', 'Pennsylvania', 'State',NULL),
('US-RI', 'US', 'RI', 'Rhode Island', 'State',NULL),
('US-SC', 'US', 'SC', 'South Carolina', 'State',NULL),
('US-SD', 'US', 'SD', 'South Dakota', 'State',NULL),
('US-TN', 'US', 'TN', 'Tennessee', 'State',NULL),
('US-TX', 'US', 'TX', 'Texas', 'State',NULL),
('US-UT', 'US', 'UT', 'Utah', 'State',NULL),
('US-VT', 'US', 'VT', 'Vermont', 'State',NULL),
('US-VA', 'US', 'VA', 'Virginia', 'State',NULL),
('US-WA', 'US', 'WA', 'Washington', 'State',NULL),
('US-WV', 'US', 'WV', 'West Virginia', 'State',NULL),
('US-WI', 'US', 'WI', 'Wisconsin', 'State',NULL),
('US-WY', 'US', 'WY', 'Wyoming', 'State',NULL),
('US-DC', 'US', 'DC', 'District of Columbia', 'District',NULL),
('US-AS', 'US', 'AS', 'American Samoa', 'Outlying area',NULL),
('US-GU', 'US', 'GU', 'Guam', 'Outlying area',NULL),
('US-MP', 'US', 'MP', 'Northern Mariana Islands', 'Outlying area',NULL),
('US-PR', 'US', 'PR', 'Puerto Rico', 'Outlying area',NULL),
('US-UM', 'US', 'UM', 'United States Minor Outlying Islands', 'Outlying area',NULL),
('US-VI', 'US', 'VI', 'Virgin Islands', 'Outlying area',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('UM', 'UMI', 'United States Minor Outlying Islands', '', '');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('UM-81', 'UM', '81', 'Baker Island', 'Territory',NULL),
('UM-84', 'UM', '84', 'Howland Island', 'Territory',NULL),
('UM-86', 'UM', '86', 'Jarvis Island', 'Territory',NULL),
('UM-67', 'UM', '67', 'Johnston Atoll', 'Territory',NULL),
('UM-89', 'UM', '89', 'Kingman Reef', 'Territory',NULL),
('UM-71', 'UM', '71', 'Midway Islands', 'Territory',NULL),
('UM-76', 'UM', '76', 'Navassa Island', 'Territory',NULL),
('UM-95', 'UM', '95', 'Palmyra Atoll', 'Territory',NULL),
('UM-79', 'UM', '79', 'Wake Island', 'Territory',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('UY', 'URY', 'Uruguay', '', 'Eastern Republic of Uruguay');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('UY-AR', 'UY', 'AR', 'Artigas', 'Department',NULL),
('UY-CA', 'UY', 'CA', 'Canelones', 'Department',NULL),
('UY-CL', 'UY', 'CL', 'Cerro Largo', 'Department',NULL),
('UY-CO', 'UY', 'CO', 'Colonia', 'Department',NULL),
('UY-DU', 'UY', 'DU', 'Durazno', 'Department',NULL),
('UY-FS', 'UY', 'FS', 'Flores', 'Department',NULL),
('UY-FD', 'UY', 'FD', 'Florida', 'Department',NULL),
('UY-LA', 'UY', 'LA', 'Lavalleja', 'Department',NULL),
('UY-MA', 'UY', 'MA', 'Maldonado', 'Department',NULL),
('UY-MO', 'UY', 'MO', 'Montevideo', 'Department',NULL),
('UY-PA', 'UY', 'PA', 'Paysandú', 'Department',NULL),
('UY-RN', 'UY', 'RN', 'Río Negro', 'Department',NULL),
('UY-RV', 'UY', 'RV', 'Rivera', 'Department',NULL),
('UY-RO', 'UY', 'RO', 'Rocha', 'Department',NULL),
('UY-SA', 'UY', 'SA', 'Salto', 'Department',NULL),
('UY-SJ', 'UY', 'SJ', 'San José', 'Department',NULL),
('UY-SO', 'UY', 'SO', 'Soriano', 'Department',NULL),
('UY-TA', 'UY', 'TA', 'Tacuarembó', 'Department',NULL),
('UY-TT', 'UY', 'TT', 'Treinta y Tres', 'Department',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('UZ', 'UZB', 'Uzbekistan', '', 'Republic of Uzbekistan');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('UZ-TK', 'UZ', 'TK', 'Toshkent', 'City',NULL),
('UZ-AN', 'UZ', 'AN', 'Andijon', 'Region',NULL),
('UZ-BU', 'UZ', 'BU', 'Buxoro', 'Region',NULL),
('UZ-FA', 'UZ', 'FA', 'Farg''ona', 'Region',NULL),
('UZ-JI', 'UZ', 'JI', 'Jizzax', 'Region',NULL),
('UZ-NG', 'UZ', 'NG', 'Namangan', 'Region',NULL),
('UZ-NW', 'UZ', 'NW', 'Navoiy', 'Region',NULL),
('UZ-QA', 'UZ', 'QA', 'Qashqadaryo', 'Region',NULL),
('UZ-SA', 'UZ', 'SA', 'Samarqand', 'Region',NULL),
('UZ-SI', 'UZ', 'SI', 'Sirdaryo', 'Region',NULL),
('UZ-SU', 'UZ', 'SU', 'Surxondaryo', 'Region',NULL),
('UZ-TO', 'UZ', 'TO', 'Toshkent', 'Region',NULL),
('UZ-XO', 'UZ', 'XO', 'Xorazm', 'Region',NULL),
('UZ-QR', 'UZ', 'QR', 'Qoraqalpog''iston Respublikasi', 'Republic',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('VU', 'VUT', 'Vanuatu', '', 'Republic of Vanuatu');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('VU-MAP', 'VU', 'MAP', 'Malampa', 'Province',NULL),
('VU-PAM', 'VU', 'PAM', 'Pénama', 'Province',NULL),
('VU-SAM', 'VU', 'SAM', 'Sanma', 'Province',NULL),
('VU-SEE', 'VU', 'SEE', 'Shéfa', 'Province',NULL),
('VU-TAE', 'VU', 'TAE', 'Taféa', 'Province',NULL),
('VU-TOB', 'VU', 'TOB', 'Torba', 'Province',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('VE', 'VEN', 'Venezuela, Bolivarian Republic of', 'Venezuela', 'Bolivarian Republic of Venezuela');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('VE-W', 'VE', 'W', 'Dependencias Federales', 'Federal Dependency',NULL),
('VE-A', 'VE', 'A', 'Distrito Federal', 'Federal District',NULL),
('VE-Z', 'VE', 'Z', 'Amazonas', 'State',NULL),
('VE-B', 'VE', 'B', 'Anzoátegui', 'State',NULL),
('VE-C', 'VE', 'C', 'Apure', 'State',NULL),
('VE-D', 'VE', 'D', 'Aragua', 'State',NULL),
('VE-E', 'VE', 'E', 'Barinas', 'State',NULL),
('VE-F', 'VE', 'F', 'Bolívar', 'State',NULL),
('VE-G', 'VE', 'G', 'Carabobo', 'State',NULL),
('VE-H', 'VE', 'H', 'Cojedes', 'State',NULL),
('VE-Y', 'VE', 'Y', 'Delta Amacuro', 'State',NULL),
('VE-I', 'VE', 'I', 'Falcón', 'State',NULL),
('VE-J', 'VE', 'J', 'Guárico', 'State',NULL),
('VE-K', 'VE', 'K', 'Lara', 'State',NULL),
('VE-L', 'VE', 'L', 'Mérida', 'State',NULL),
('VE-M', 'VE', 'M', 'Miranda', 'State',NULL),
('VE-N', 'VE', 'N', 'Monagas', 'State',NULL),
('VE-O', 'VE', 'O', 'Nueva Esparta', 'State',NULL),
('VE-P', 'VE', 'P', 'Portuguesa', 'State',NULL),
('VE-R', 'VE', 'R', 'Sucre', 'State',NULL),
('VE-S', 'VE', 'S', 'Táchira', 'State',NULL),
('VE-T', 'VE', 'T', 'Trujillo', 'State',NULL),
('VE-X', 'VE', 'X', 'Vargas', 'State',NULL),
('VE-U', 'VE', 'U', 'Yaracuy', 'State',NULL),
('VE-V', 'VE', 'V', 'Zulia', 'State',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('VN', 'VNM', 'Viet Nam', '', 'Socialist Republic of Viet Nam');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('VN-44', 'VN', '44', 'An Giang', 'Province',NULL),
('VN-43', 'VN', '43', 'Bà Rịa-Vũng Tàu', 'Province',NULL),
('VN-54', 'VN', '54', 'Bắc Giang', 'Province',NULL),
('VN-53', 'VN', '53', 'Bắc Kạn', 'Province',NULL),
('VN-55', 'VN', '55', 'Bạc Liêu', 'Province',NULL),
('VN-56', 'VN', '56', 'Bắc Ninh', 'Province',NULL),
('VN-50', 'VN', '50', 'Bến Tre', 'Province',NULL),
('VN-31', 'VN', '31', 'Bình Định', 'Province',NULL),
('VN-57', 'VN', '57', 'Bình Dương', 'Province',NULL),
('VN-58', 'VN', '58', 'Bình Phước', 'Province',NULL),
('VN-40', 'VN', '40', 'Bình Thuận', 'Province',NULL),
('VN-59', 'VN', '59', 'Cà Mau', 'Province',NULL),
('VN-04', 'VN', '04', 'Cao Bằng', 'Province',NULL),
('VN-33', 'VN', '33', 'Đắc Lắk', 'Province',NULL),
('VN-72', 'VN', '72', 'Đắk Nông', 'Province',NULL),
('VN-71', 'VN', '71', 'Điện Biên', 'Province',NULL),
('VN-39', 'VN', '39', 'Đồng Nai', 'Province',NULL),
('VN-45', 'VN', '45', 'Đồng Tháp', 'Province',NULL),
('VN-30', 'VN', '30', 'Gia Lai', 'Province',NULL),
('VN-03', 'VN', '03', 'Hà Giang', 'Province',NULL),
('VN-63', 'VN', '63', 'Hà Nam', 'Province',NULL),
('VN-15', 'VN', '15', 'Hà Tây', 'Province',NULL),
('VN-23', 'VN', '23', 'Hà Tỉnh', 'Province',NULL),
('VN-61', 'VN', '61', 'Hải Duong', 'Province',NULL),
('VN-73', 'VN', '73', 'Hậu Giang', 'Province',NULL),
('VN-14', 'VN', '14', 'Hoà Bình', 'Province',NULL),
('VN-66', 'VN', '66', 'Hưng Yên', 'Province',NULL),
('VN-34', 'VN', '34', 'Khánh Hòa', 'Province',NULL),
('VN-47', 'VN', '47', 'Kiên Giang', 'Province',NULL),
('VN-28', 'VN', '28', 'Kon Tum', 'Province',NULL),
('VN-01', 'VN', '01', 'Lai Châu', 'Province',NULL),
('VN-35', 'VN', '35', 'Lâm Đồng', 'Province',NULL),
('VN-09', 'VN', '09', 'Lạng Sơn', 'Province',NULL),
('VN-02', 'VN', '02', 'Lào Cai', 'Province',NULL),
('VN-41', 'VN', '41', 'Long An', 'Province',NULL),
('VN-67', 'VN', '67', 'Nam Định', 'Province',NULL),
('VN-22', 'VN', '22', 'Nghệ An', 'Province',NULL),
('VN-18', 'VN', '18', 'Ninh Bình', 'Province',NULL),
('VN-36', 'VN', '36', 'Ninh Thuận', 'Province',NULL),
('VN-68', 'VN', '68', 'Phú Thọ', 'Province',NULL),
('VN-32', 'VN', '32', 'Phú Yên', 'Province',NULL),
('VN-24', 'VN', '24', 'Quảng Bình', 'Province',NULL),
('VN-27', 'VN', '27', 'Quảng Nam', 'Province',NULL),
('VN-29', 'VN', '29', 'Quảng Ngãi', 'Province',NULL),
('VN-13', 'VN', '13', 'Quảng Ninh', 'Province',NULL),
('VN-25', 'VN', '25', 'Quảng Trị', 'Province',NULL),
('VN-52', 'VN', '52', 'Sóc Trăng', 'Province',NULL),
('VN-05', 'VN', '05', 'Sơn La', 'Province',NULL),
('VN-37', 'VN', '37', 'Tây Ninh', 'Province',NULL),
('VN-20', 'VN', '20', 'Thái Bình', 'Province',NULL),
('VN-69', 'VN', '69', 'Thái Nguyên', 'Province',NULL),
('VN-21', 'VN', '21', 'Thanh Hóa', 'Province',NULL),
('VN-26', 'VN', '26', 'Thừa Thiên-Huế', 'Province',NULL),
('VN-46', 'VN', '46', 'Tiền Giang', 'Province',NULL),
('VN-51', 'VN', '51', 'Trà Vinh', 'Province',NULL),
('VN-07', 'VN', '07', 'Tuyên Quang', 'Province',NULL),
('VN-49', 'VN', '49', 'Vĩnh Long', 'Province',NULL),
('VN-70', 'VN', '70', 'Vĩnh Phúc', 'Province',NULL),
('VN-06', 'VN', '06', 'Yên Bái', 'Province',NULL),
('VN-CT', 'VN', 'CT', 'Cần Thơ', 'Municipality',NULL),
('VN-DN', 'VN', 'DN', 'Đà Nẵng', 'Municipality',NULL),
('VN-HN', 'VN', 'HN', 'Hà Nội', 'Municipality',NULL),
('VN-HP', 'VN', 'HP', 'Hải Phòng', 'Municipality',NULL),
('VN-SG', 'VN', 'SG', 'Hồ Chí Minh [Sài Gòn]', 'Municipality',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('VG', 'VGB', 'Virgin Islands, British', '', 'British Virgin Islands');

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('VI', 'VIR', 'Virgin Islands, U.S.', '', 'Virgin Islands of the United States');

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('WF', 'WLF', 'Wallis and Futuna', '', '');

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('EH', 'ESH', 'Western Sahara', '', '');

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('YE', 'YEM', 'Yemen', '', 'Republic of Yemen');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('YE-AB', 'YE', 'AB', 'Abyān', 'Governorate',NULL),
('YE-AD', 'YE', 'AD', '''Adan', 'Governorate',NULL),
('YE-DA', 'YE', 'DA', 'Aḑ Ḑāli‘', 'Governorate',NULL),
('YE-BA', 'YE', 'BA', 'Al Bayḑā''', 'Governorate',NULL),
('YE-MU', 'YE', 'MU', 'Al Ḩudaydah', 'Governorate',NULL),
('YE-JA', 'YE', 'JA', 'Al Jawf', 'Governorate',NULL),
('YE-MR', 'YE', 'MR', 'Al Mahrah', 'Governorate',NULL),
('YE-MW', 'YE', 'MW', 'Al Maḩwīt', 'Governorate',NULL),
('YE-AM', 'YE', 'AM', '''Amrān', 'Governorate',NULL),
('YE-DH', 'YE', 'DH', 'Dhamār', 'Governorate',NULL),
('YE-HD', 'YE', 'HD', 'Ḩaḑramawt', 'Governorate',NULL),
('YE-HJ', 'YE', 'HJ', 'Ḩajjah', 'Governorate',NULL),
('YE-IB', 'YE', 'IB', 'Ibb', 'Governorate',NULL),
('YE-LA', 'YE', 'LA', 'Laḩij', 'Governorate',NULL),
('YE-MA', 'YE', 'MA', 'Ma''rib', 'Governorate',NULL),
('YE-RA', 'YE', 'RA', 'Raymah', 'Governorate',NULL),
('YE-SD', 'YE', 'SD', 'Şa''dah', 'Governorate',NULL),
('YE-SN', 'YE', 'SN', 'Şan''ā''', 'Governorate',NULL),
('YE-SH', 'YE', 'SH', 'Shabwah', 'Governorate',NULL),
('YE-TA', 'YE', 'TA', 'Tā''izz', 'Governorate',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('ZM', 'ZMB', 'Zambia', '', 'Republic of Zambia');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('ZM-02', 'ZM', '02', 'Central', 'Province',NULL),
('ZM-08', 'ZM', '08', 'Copperbelt', 'Province',NULL),
('ZM-03', 'ZM', '03', 'Eastern', 'Province',NULL),
('ZM-04', 'ZM', '04', 'Luapula', 'Province',NULL),
('ZM-09', 'ZM', '09', 'Lusaka', 'Province',NULL),
('ZM-05', 'ZM', '05', 'Northern', 'Province',NULL),
('ZM-06', 'ZM', '06', 'North-Western', 'Province',NULL),
('ZM-07', 'ZM', '07', 'Southern (Zambia)', 'Province',NULL),
('ZM-01', 'ZM', '01', 'Western', 'Province',NULL);

INSERT INTO countries (country_id, alpha_3, name, common_name, official_name)
VALUES ('ZW', 'ZWE', 'Zimbabwe', '', 'Republic of Zimbabwe');
INSERT INTO regions (region_id, country_id, abbreviation, name, type, parent) VALUES
('ZW-BU', 'ZW', 'BU', 'Bulawayo', 'City',NULL),
('ZW-HA', 'ZW', 'HA', 'Harare', 'City',NULL),
('ZW-MA', 'ZW', 'MA', 'Manicaland', 'Province',NULL),
('ZW-MC', 'ZW', 'MC', 'Mashonaland Central', 'Province',NULL),
('ZW-ME', 'ZW', 'ME', 'Mashonaland East', 'Province',NULL),
('ZW-MW', 'ZW', 'MW', 'Mashonaland West', 'Province',NULL),
('ZW-MV', 'ZW', 'MV', 'Masvingo', 'Province',NULL),
('ZW-MN', 'ZW', 'MN', 'Matabeleland North', 'Province',NULL),
('ZW-MS', 'ZW', 'MS', 'Matabeleland South', 'Province',NULL),
('ZW-MI', 'ZW', 'MI', 'Midlands', 'Province',NULL);


UPDATE regions SET is_parent = 1 WHERE region_id IN ('AL-01','AL-09','AL-12','AL-06','AL-09','AL-02','AL-03','AL-04','AL-03','AL-05','AL-07','AL-11','AL-06','AL-06','AL-02','AL-01','AL-07','AL-08','AL-08','AL-03','AL-04','AL-10','AL-04','AL-09','AL-08','AL-03','AL-05','AL-06','AL-10','AL-12','AL-01','AL-10','AL-05','AL-11','AL-07','AL-12','AZ-NX','AZ-NX','AZ-NX','AZ-NX','AZ-NX','AZ-NX','AZ-NX','AZ-NX','BD-D','BD-B','BD-A','BD-A','BD-A','BD-E','BD-B','BD-B','BD-B','BD-D','BD-B','BD-B','BD-C','BD-F','BD-C','BD-B','BD-F','BD-C','BD-C','BD-G','BD-E','BD-C','BD-D','BD-A','BD-D','BD-B','BD-D','BD-C','BD-F','BD-D','BD-B','BD-F','BD-C','BD-D','BD-C','BD-D','BD-G','BD-C','BD-C','BD-E','BD-D','BD-C','BD-C','BD-E','BD-E','BD-C','BD-F','BD-B','BD-E','BD-F','BD-A','BD-A','BD-C','BD-E','BD-B','BD-F','BD-D','BD-C','BD-C','BD-E','BD-G','BD-G','BD-C','BD-F','BE-VLG','BE-WAL','BE-WAL','BE-WAL','BE-VLG','BE-WAL','BE-WAL','BE-VLG','BE-VLG','BE-VLG','BA-BIH','BA-BIH','BA-BIH','BA-BIH','BA-BIH','BA-BIH','BA-BIH','BA-BIH','BA-BIH','BA-BIH','BF-01','BF-05','BF-01','BF-07','BF-13','BF-04','BF-06','BF-02','BF-11','BF-08','BF-08','BF-09','BF-13','BF-03','BF-09','BF-08','BF-08','BF-01','BF-04','BF-04','BF-11','BF-02','BF-10','BF-01','BF-07','BF-05','BF-01','BF-13','BF-11','BF-12','BF-10','BF-13','BF-06','BF-05','BF-12','BF-06','BF-12','BF-01','BF-08','BF-09','BF-12','BF-10','BF-06','BF-10','BF-07','CV-B','CV-S','CV-S','CV-S','CV-B','CV-B','CV-S','CV-B','CV-B','CV-S','CV-B','CV-S','CV-S','CV-S','CV-S','CV-S','CV-S','CV-S','CV-S','CV-B','CV-S','CV-S','CZ-ST','CZ-ST','CZ-JM','CZ-JM','CZ-JM','CZ-MO','CZ-JM','CZ-LI','CZ-JC','CZ-JC','CZ-US','CZ-PL','CZ-MO','CZ-VY','CZ-JM','CZ-KR','CZ-KA','CZ-US','CZ-PA','CZ-LI','CZ-OL','CZ-KR','CZ-VY','CZ-JC','CZ-KA','CZ-MO','CZ-ST','CZ-PL','CZ-ST','CZ-ZL','CZ-ST','CZ-LI','CZ-US','CZ-US','CZ-ST','CZ-ST','CZ-US','CZ-KR','CZ-MO','CZ-ST','CZ-OL','CZ-MO','CZ-MO','CZ-PA','CZ-VY','CZ-JC','CZ-PL','CZ-PL','CZ-PL','CZ-PR','CZ-PR','CZ-PR','CZ-PR','CZ-PR','CZ-PR','CZ-PR','CZ-PR','CZ-PR','CZ-PR','CZ-PR','CZ-PR','CZ-PR','CZ-PR','CZ-PR','CZ-ST','CZ-ST','CZ-JC','CZ-OL','CZ-OL','CZ-ST','CZ-ST','CZ-PL','CZ-KR','CZ-LI','CZ-KA','CZ-JC','CZ-PA','CZ-OL','CZ-JC','CZ-PL','CZ-US','CZ-KR','CZ-VY','CZ-ZL','CZ-US','CZ-PA','CZ-ZL','CZ-JM','CZ-ZL','CZ-JM','CZ-VY','GQ-I','GQ-I','GQ-I','GQ-C','GQ-C','GQ-C','GQ-C','FR-V','FR-S','FR-C','FR-U','FR-U','FR-V','FR-G','FR-N','FR-G','FR-K','FR-N','FR-A','FR-U','FR-P','FR-C','FR-T','FR-T','FR-F','FR-L','FR-H','FR-D','FR-E','FR-L','FR-T','FR-B','FR-I','FR-V','FR-J','FR-Q','FR-F','FR-E','FR-K','FR-N','FR-B','FR-H','FR-N','FR-C','FR-G','FR-U','FR-I','FR-V','FR-N','FR-L','FR-A','FR-J','FR-K','FR-E','FR-F','FR-F','FR-V','FR-I','FR-B','FR-F','FR-V','FR-R','FR-F','FR-N','FR-B','FR-K','FR-R','FR-P','FR-G','FR-R','FR-M','FR-M','FR-E','FR-M','FR-D','FR-O','FR-S','FR-P','FR-J','FR-O','FR-C','FR-B','FR-K','FR-V','FR-D','FR-R','FR-V','FR-J','FR-Q','FR-J','FR-S','FR-N','FR-N','FR-I','FR-J','FR-J','FR-U','FR-U','FR-R','FR-T','FR-M','FR-D','FR-J','GR-G','GR-G','GR-J','GR-J','GR-F','GR-I','GR-B','GR-M','GR-K','GR-L','GR-A','GR-A','GR-H','GR-H','GR-C','GR-H','GR-H','GR-C','GR-G','GR-B','GR-D','GR-M','GR-E','GR-C','GR-A','GR-F','GR-F','GR-B','GR-J','GR-C','GR-L','GR-J','GR-E','GR-M','GR-F','GR-K','GR-E','GR-J','GR-B','GR-B','GR-D','GR-M','GR-A','GR-K','GR-B','GR-D','GR-B','GR-E','GR-H','GR-A','GR-F','GN-N','GN-B','GN-B','GN-D','GN-F','GN-M','GN-F','GN-D','GN-F','GN-D','GN-B','GN-B','GN-N','GN-K','GN-K','GN-D','GN-F','GN-L','GN-B','GN-K','GN-L','GN-L','GN-N','GN-N','GN-L','GN-M','GN-K','GN-N','GN-M','GN-K','GN-D','GN-L','GN-N','GW-L','GW-N','GW-S','GW-N','GW-L','GW-N','GW-S','GW-S','ID-SM','ID-NU','ID-SM','ID-JW','ID-SM','ID-SL','ID-SM','ID-JW','ID-JW','ID-JW','ID-KA','ID-KA','ID-KA','ID-KA','ID-SM','ID-SM','ID-ML','ID-ML','ID-NU','ID-NU','ID-IJ','ID-IJ','ID-SM','ID-SL','ID-SL','ID-SL','ID-SL','ID-SL','ID-SM','ID-SM','ID-SM','ID-JW','ID-JW','IE-L','IE-U','IE-M','IE-M','IE-U','IE-L','IE-C','IE-M','IE-L','IE-L','IE-L','IE-C','IE-M','IE-L','IE-L','IE-C','IE-L','IE-U','IE-L','IE-C','IE-C','IE-M','IE-M','IE-L','IE-L','IE-L','IT-82','IT-21','IT-57','IT-23','IT-52','IT-57','IT-21','IT-72','IT-75','IT-75','IT-34','IT-72','IT-25','IT-21','IT-45','IT-32','IT-25','IT-75','IT-88','IT-82','IT-67','IT-88','IT-72','IT-82','IT-78','IT-65','IT-25','IT-78','IT-25','IT-78','IT-21','IT-82','IT-57','IT-45','IT-52','IT-75','IT-45','IT-62','IT-42','IT-36','IT-52','IT-42','IT-67','IT-42','IT-65','IT-62','IT-75','IT-25','IT-52','IT-25','IT-52','IT-57','IT-25','IT-52','IT-77','IT-88','IT-82','IT-25','IT-45','IT-25','IT-72','IT-21','IT-88','IT-88','IT-88','IT-88','IT-34','IT-82','IT-45','IT-25','IT-55','IT-57','IT-65','IT-45','IT-52','IT-52','IT-36','IT-77','IT-52','IT-82','IT-45','IT-78','IT-45','IT-62','IT-45','IT-62','IT-34','IT-72','IT-88','IT-42','IT-52','IT-82','IT-25','IT-75','IT-65','IT-55','IT-21','IT-82','IT-32','IT-34','IT-36','IT-36','IT-25','IT-34','IT-21','IT-21','IT-34','IT-78','IT-34','IT-62','MW-S','MW-S','MW-S','MW-S','MW-N','MW-C','MW-C','MW-N','MW-C','MW-N','MW-C','MW-S','MW-S','MW-C','MW-S','MW-S','MW-N','MW-N','MW-N','MW-C','MW-S','MW-C','MW-C','MW-S','MW-N','MW-C','MW-S','MW-S','MV-NC','MV-NC','MV-NO','MV-CE','MV-CE','MV-SC','MV-SC','MV-SU','MV-UN','MV-UN','MV-NC','MV-US','MV-NO','MV-CE','MV-NO','MV-NO','MV-SU','MV-UN','MV-US','MV-NC','MH-L','MH-T','MH-T','MH-T','MH-L','MH-L','MH-L','MH-L','MH-L','MH-L','MH-L','MH-L','MH-T','MH-T','MH-T','MH-T','MH-T','MH-L','MH-L','MH-L','MH-L','MH-T','MH-L','MH-T','MA-11','MA-03','MA-14','MA-12','MA-12','MA-09','MA-04','MA-15','MA-05','MA-01','MA-11','MA-13','MA-06','MA-10','MA-06','MA-11','MA-14','MA-04','MA-14','MA-06','MA-04','MA-11','MA-02','MA-07','MA-06','MA-09','MA-15','MA-01','MA-08','MA-05','MA-04','MA-08','MA-13','MA-16','MA-10','MA-05','MA-09','MA-02','MA-14','MA-03','MA-04','MA-13','MA-14','MA-03','MA-13','MA-13','MA-13','MA-16','MA-08','MA-01','MA-05','MA-13','MA-11','MA-11','MA-06','MA-08','MA-04','MA-07','MA-07','MA-11','MA-07','MA-01','MA-01','NP-1','NP-2','NP-3','NP-3','NP-1','NP-2','NP-4','NP-3','NP-5','NP-4','NP-1','NP-2','NP-4','NP-5','NZ-N','NZ-N','NZ-S','NZ-N','NZ-N','NZ-N','NZ-S','NZ-S','NZ-N','NZ-N','NZ-N','NZ-S','NZ-N','NZ-S','NZ-S','NZ-S','PH-15','PH-13','PH-13','PH-06','PH-05','PH-06','PH-15','PH-03','PH-09','PH-03','PH-02','PH-40','PH-15','PH-08','PH-07','PH-10','PH-03','PH-02','PH-05','PH-05','PH-10','PH-06','PH-05','PH-40','PH-07','PH-11','PH-11','PH-11','PH-11','PH-13','PH-08','PH-06','PH-15','PH-01','PH-01','PH-06','PH-02','PH-15','PH-40','PH-12','PH-14','PH-01','PH-08','PH-14','PH-41','PH-05','PH-41','PH-41','PH-10','PH-10','PH-15','PH-06','PH-07','PH-12','PH-08','PH-03','PH-02','PH-41','PH-03','PH-01','PH-40','PH-02','PH-40','PH-41','PH-11','PH-07','PH-05','PH-11','PH-08','PH-12','PH-14','PH-13','PH-13','PH-03','PH-14','PH-08','PH-03','PH-09','PH-09','PH-09','KN-K','KN-K','KN-K','KN-N','KN-N','KN-K','KN-N','KN-K','KN-K','KN-N','KN-K','KN-N','KN-K','KN-K','RS-VO','RS-VO','RS-KM','RS-KM','RS-KM','RS-KM','RS-KM','RS-VO','RS-VO','RS-VO','RS-VO','RS-VO','ES-GA','ES-PV','ES-CM','ES-VC','ES-AN','ES-AS','ES-CL','ES-EX','ES-CT','ES-CL','ES-EX','ES-AN','ES-CB','ES-VC','ES-CM','ES-AN','ES-CM','ES-CT','ES-AN','ES-CM','ES-PV','ES-AN','ES-AR','ES-AN','ES-RI','ES-CN','ES-CL','ES-CT','ES-GA','ES-MD','ES-AN','ES-MC','ES-NC','ES-GA','ES-CL','ES-IB','ES-GA','ES-CL','ES-CN','ES-CL','ES-AN','ES-CL','ES-CT','ES-AR','ES-CM','ES-VC','ES-CL','ES-PV','ES-CL','ES-AR','LK-5','LK-7','LK-8','LK-5','LK-1','LK-3','LK-1','LK-3','LK-4','LK-1','LK-2','LK-9','LK-4','LK-6','LK-4','LK-2','LK-3','LK-8','LK-4','LK-2','LK-7','LK-6','LK-9','LK-5','LK-4','UG-N','UG-N','UG-N','UG-E','UG-N','UG-N','UG-N','UG-E','UG-E','UG-E','UG-E','UG-E','UG-W','UG-W','UG-W','UG-E','UG-E','UG-N','UG-N','UG-W','UG-W','UG-E','UG-W','UG-E','UG-N','UG-W','UG-W','UG-E','UG-C','UG-E','UG-C','UG-E','UG-W','UG-W','UG-E','UG-W','UG-E','UG-C','UG-W','UG-C','UG-W','UG-W','UG-N','UG-N','UG-N','UG-E','UG-W','UG-N','UG-C','UG-C','UG-E','UG-N','UG-C','UG-W','UG-E','UG-E','UG-W','UG-C','UG-N','UG-N','UG-C','UG-C','UG-C','UG-N','UG-C','UG-C','UG-E','UG-N','UG-W','UG-N','UG-N','UG-E','UG-C','UG-W','UG-C','UG-E','UG-E','UG-E','UG-C','UG-N');


drop index if exists countries_idx1;
drop index if exists countries_idx2;

CREATE INDEX countries_idx1
  ON countries(country_id);

CREATE INDEX countries_idx2
  ON countries(alpha_3);


drop index if exists regions_idx1;
drop index if exists regions_idx2;
drop index if exists regions_idx3;
drop index if exists regions_idx4;


CREATE INDEX regions_idx1
  ON regions(region_id);
  
CREATE INDEX regions_idx2
  ON regions(country_id);
  
CREATE INDEX regions_idx3
  ON regions(parent);
  
CREATE INDEX regions_idx4
  ON regions(is_parent);
  
INSERT into regions (region_id,country_id,abbreviation,name,parent,type) 
    select country_id || '-' || country_id as region_id, country_id as country_id, country_id as abbreviation, name as name, null as parent,'Country-no-regions' as type
    from countries
    where country_id not in (
        select distinct country_id from regions
    );
