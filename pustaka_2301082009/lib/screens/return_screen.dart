import 'package:flutter/material.dart';

class ReturnScreen extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text('Returns'),
      ),
      body: ListView.builder(
        itemCount: 0, // Replace with actual data length
        itemBuilder: (context, index) {
          return ListTile(
            title: Text('Member - Book'), // Replace with actual return data
            subtitle: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Text('Return Date'), // Replace with actual date
                Text('Fine: \$0'), // Replace with actual fine
              ],
            ),
            trailing: IconButton(
              icon: Icon(Icons.info),
              onPressed: () {
                // Show return details
              },
            ),
          );
        },
      ),
    );
  }
}