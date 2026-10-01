CREATE DATABASE louistore;

USE louistore;

CREATE TABLE game (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_game VARCHAR(100) NOT NULL,
    gambar VARCHAR(255) NOT NULL,
    deskripsi TEXT
);

CREATE TABLE produk (
    id INT AUTO_INCREMENT PRIMARY KEY,
    game_id INT NOT NULL,
    nama_produk VARCHAR(100) NOT NULL,
    nominal VARCHAR(100) NOT NULL,
    harga INT NOT NULL,
    FOREIGN KEY (game_id) REFERENCES game(id)
);

CREATE TABLE pesanan (
    id INT AUTO_INCREMENT PRIMARY KEY,
    invoice VARCHAR(50) NOT NULL,
    game_id INT NOT NULL,
    produk_id INT NOT NULL,
    user_id VARCHAR(100) NOT NULL,
    server_id VARCHAR(100),
    nama VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    pembayaran VARCHAR(50) NOT NULL,
    total INT NOT NULL,
    status VARCHAR(30) DEFAULT 'Pending',
    tanggal TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


INSERT INTO game
(nama_game, gambar, deskripsi)
VALUES
(
    'Mobile Legends',
    'https://images.unsplash.com/photo-1542751371-adc38448a05e?auto=format&fit=crop&w=800&q=80',
    'Top up Diamond Mobile Legends dengan cepat dan mudah.'
),
(
    'Free Fire',
    'https://images.unsplash.com/photo-1511512578047-dfb367046420?auto=format&fit=crop&w=800&q=80',
    'Top up Diamond Free Fire murah dan cepat.'
),
(
    'PUBG Mobile',
    'https://images.unsplash.com/photo-1552820728-8b83bb6b773f?auto=format&fit=crop&w=800&q=80',
    'Top up UC PUBG Mobile.'
),
(
    'Valorant',
    'https://images.unsplash.com/photo-1542751110-97427bbecf20?auto=format&fit=crop&w=800&q=80',
    'Top up Valorant Points.'
);


INSERT INTO produk
(game_id, nama_produk, nominal, harga)
VALUES

(1, '86 Diamonds', '86 Diamond', 20000),
(1, '172 Diamonds', '172 Diamond', 39000),
(1, '257 Diamonds', '257 Diamond', 57000),
(1, '344 Diamonds', '344 Diamond', 75000),

(2, '70 Diamonds', '70 Diamond', 10000),
(2, '140 Diamonds', '140 Diamond', 19000),
(2, '355 Diamonds', '355 Diamond', 47000),

(3, '60 UC', '60 UC', 16000),
(3, '325 UC', '325 UC', 75000),
(3, '660 UC', '660 UC', 145000),

(4, '475 VP', '475 VP', 55000),
(4, '1000 VP', '1000 VP', 105000);
