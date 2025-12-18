<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "sistem_ijin");

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}