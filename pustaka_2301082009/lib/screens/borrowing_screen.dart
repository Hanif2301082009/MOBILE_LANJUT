import 'package:flutter/material.dart';

class BorrowingScreen extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text('Borrowing'),
      ),
      body: ListView.builder(
        itemCount: 0, // Replace with actual data length
        itemBuilder: (context, index) {
          return ListTile(
            title: Text('Member - Book'), // Replace with actual borrowing data
            subtitle: Text('Borrowing Date'), // Replace with actual date
            trailing: IconButton(
              icon: Icon(Icons.info),
              onPressed: () {
                // Show borrowing details
              },
            ),
          );
        },
      ),
      floatingActionButton: FloatingActionButton(
        onPressed: () {
          // Add new borrowing
        },
        child: Icon(Icons.add),
      ),
    );
  }
}
