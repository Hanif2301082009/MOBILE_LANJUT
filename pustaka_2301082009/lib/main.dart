import 'package:flutter/material.dart';
import 'screens/home_screen.dart';
import 'screens/member_screen.dart';
import 'screens/book_screen.dart';
import 'screens/borrowing_screen.dart';
import 'screens/return_screen.dart';

void main() {
  runApp(LibraryApp());
}

class LibraryApp extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      title: 'Library Management',
      theme: ThemeData(
        primarySwatch: Colors.blue,
        visualDensity: VisualDensity.adaptivePlatformDensity,
      ),
      home: HomeScreen(),
    );
  }
}
