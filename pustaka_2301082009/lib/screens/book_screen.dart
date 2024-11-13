import 'package:flutter/material.dart';

class BookScreen extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text('Books'),
      ),
      body: ListView.builder(
        itemCount: 0, // Replace with actual data length
        itemBuilder: (context, index) {
          return ListTile(
            title: Text('Book Title'), // Replace with actual book data
            subtitle: Text('Author'), // Replace with actual author
            trailing: Row(
              mainAxisSize: MainAxisSize.min,
              children: [
                IconButton(
                  icon: Icon(Icons.edit),
                  onPressed: () {
                    // Edit book
                  },
                ),
                IconButton(
                  icon: Icon(Icons.delete),
                  onPressed: () {
                    // Delete book
                  },
                ),
              ],
            ),
          );
        },
      ),
      floatingActionButton: FloatingActionButton(
        onPressed: () {
          // Add new book
        },
        child: Icon(Icons.add),
      ),
    );
  }
}