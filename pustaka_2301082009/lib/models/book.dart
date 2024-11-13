class Book {
  final String id;
  final String judul;
  final String pengarang;
  final String penerbit;
  final String tahunTerbit;

  Book({
    required this.id,
    required this.judul,
    required this.pengarang,
    required this.penerbit,
    required this.tahunTerbit,
  });

  factory Book.fromJson(Map<String, dynamic> json) {
    return Book(
      id: json['id'],
      judul: json['judul'],
      pengarang: json['pengarang'],
      penerbit: json['penerbit'],
      tahunTerbit: json['tahun_terbit'],
    );
  }
}