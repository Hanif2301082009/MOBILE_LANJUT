import 'package:flutter/material.dart';

class MemberScreen extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text('Members'),
      ),
      body: ListView.builder(
        itemCount: 0, // Replace with actual data length
        itemBuilder: (context, index) {
          return ListTile(
            title: Text('Member Name'), // Replace with actual member data
            subtitle: Text('NIM'), // Replace with actual NIM
            trailing: Row(
              mainAxisSize: MainAxisSize.min,
              children: [
                IconButton(
                  icon: Icon(Icons.edit),
                  onPressed: () {
                    // Edit member
                  },
                ),
                IconButton(
                  icon: Icon(Icons.delete),
                  onPressed: () {
                    // Delete member
                  },
                ),
              ],
            ),
          );
        },
      ),
      floatingActionButton: FloatingActionButton(
        onPressed: () {
          // Add new member
        },
        child: Icon(Icons.add),
      ),
    );
  }
}