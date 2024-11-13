import 'package:flutter/material.dart';
import 'package:pustaka_2301082009/screens/book_screen.dart';
import 'package:pustaka_2301082009/screens/borrowing_screen.dart';
import 'package:pustaka_2301082009/screens/member_screen.dart';
import 'package:pustaka_2301082009/screens/return_screen.dart';

class HomeScreen extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text('Library Management System'),
      ),
      drawer: buildDrawer(context),
      body: Center(
        child: Text(
          'Welcome to Library Management System',
          style: TextStyle(fontSize: 24),
        ),
      ),
    );
  }

  Widget buildDrawer(BuildContext context) {
    return Drawer(
      child: ListView(
        padding: EdgeInsets.zero,
        children: <Widget>[
          DrawerHeader(
            decoration: BoxDecoration(
              color: Colors.blue,
            ),
            child: Text(
              'Library Menu',
              style: TextStyle(
                color: Colors.white,
                fontSize: 24,
              ),
            ),
          ),
          ListTile(
            leading: Icon(Icons.person),
            title: Text('Members'),
            onTap: () {
              Navigator.push(
                context,
                MaterialPageRoute(builder: (context) => MemberScreen()),
              );
            },
          ),
          ListTile(
            leading: Icon(Icons.book),
            title: Text('Books'),
            onTap: () {
              Navigator.push(
                context,
                MaterialPageRoute(builder: (context) => BookScreen()),
              );
            },
          ),
          ListTile(
            leading: Icon(Icons.assignment_return),
            title: Text('Borrowing'),
            onTap: () {
              Navigator.push(
                context,
                MaterialPageRoute(builder: (context) => BorrowingScreen()),
              );
            },
          ),
          ListTile(
            leading: Icon(Icons.assignment_turned_in),
            title: Text('Returns'),
            onTap: () {
              Navigator.push(
                context,
                MaterialPageRoute(builder: (context) => ReturnScreen()),
              );
            },
          ),
        ],
      ),
    );
  }
}