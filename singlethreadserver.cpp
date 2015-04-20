/*
  From Stevens Unix Network Programming, vol 1.
  Minor modifications by John Sterling
 */

#include <stdio.h>       // perror, snprintf
#include <stdlib.h>      // exit
#include <unistd.h>      // close, write
#include <string.h>      // strlen
#include <strings.h>     // bzero
#include <time.h>        // time, ctime
#include <sys/socket.h>  // socket, AF_INET, SOCK_STREAM,
#include <netinet/in.h>  // servaddr, INADDR_ANY, htons
#include <iostream> 
#include <sstream>
#include <string>
#include <vector>
#include <fstream>
#include <mutex>
#include <pthread.h>
#define	MAXLINE		4096	// max text line length
#define	BUFFSIZE	8192    // buffer size for reads and writes
#define  SA struct sockaddr
#define	LISTENQ		1024	// 2nd argument to listen()
#define PORT_NUM        13002
#define NUM_THREADS     5
using namespace std;
void getUsers(int connfd){
	ifstream myfile ("txt/users.txt");
	string line;
	string output="";
	if(!myfile.is_open()){
	cerr << "File not found"<<endl;
	}
	else{
		while (getline(myfile,line))
		{
			output+=line+"`";
		}
		output.pop_back();
		myfile.close();
		myfile.clear();
		myfile.seekg(0, myfile.beg);
		write(connfd,output.c_str(),output.size());

	}
}
void getTweets(int connfd){
	ifstream myfile ("txt/tweets.txt");
	string line;
	string output="";
	if(!myfile.is_open()){
	cerr << "File not found"<<endl;
	}
	else{
		while (getline(myfile,line))
		{
			output+=line+"`";
		}
		output.pop_back();
		myfile.close();
		myfile.clear();
		myfile.seekg(0, myfile.beg);
		write(connfd,output.c_str(),output.size());
	}
}
void getFollowers(int connfd){
	ifstream myfile ("txt/followers.txt");
	string line;
	string output="";
	if(!myfile.is_open()){
	cerr << "File not found"<<endl;
	}
	else{
		while (getline(myfile,line))
		{
			output+=line+"`";
		}
		output.pop_back();
		myfile.close();
		myfile.clear();
		myfile.seekg(0, myfile.beg);
		write(connfd,output.c_str(),output.size());
	}
}
void addUser(const string &user,int connfd){
	ofstream myfile("txt/users.txt", ios::app);
	if(!myfile.is_open()){
	cerr << "File not found"<<endl;
	}
	else{
		myfile << user<<endl;
		myfile.close();
		//write(connfd,user.c_str(),user.size());
	}
}
void createTweet(string tweet,int connfd){
	ofstream myfile("txt/tweets.txt", ios::app);
	if(!myfile.is_open()){
	cerr << "File not found"<<endl;
	}
	else{
		myfile<<tweet<<endl;
		myfile.close();
		// write(connfd,tweet.c_str(),tweet.size());
	}
}
void addFollower(const string &followers){
	ofstream myfile("txt/followers.txt", ios::app);
	if(!myfile.is_open()){
	cerr << "File not found"<<endl;
	}
	else{
		myfile<<followers<<endl;
		myfile.close();
	}
}
void deleteFollower(const string &followers){
	ifstream myfile ("txt/followers.txt");
	if(!myfile.is_open()){
	cerr << "File not found"<<endl;
	}
	else{
		ofstream temp;
		temp.open("txt/temp.txt");
		string line="";
		while (getline(myfile,line))
		{
			if (line != followers)
			{
				temp << line << endl;
			}
		}
		temp.close();
		myfile.close();
		remove("txt/followers.txt");
		rename("txt/temp.txt","txt/followers.txt");
	}
}
int main(int argc, char **argv) {
    int			listenfd, connfd;  // Unix file descriptors
    struct sockaddr_in	servaddr;          // Note C use of struct
    char		buff[MAXLINE];

    // 1. Create the socket
    if ((listenfd = socket(AF_INET, SOCK_STREAM, 0)) == -1) {
        perror("Unable to create a socket");
        exit(1);
    }

    // 2. Set up the sockaddr_in

    // zero it.  
    // bzero(&servaddr, sizeof(servaddr)); // Note bzero is "deprecated".  Sigh.
    memset(&servaddr, 0, sizeof(servaddr));
    servaddr.sin_family      = AF_INET; // Specify the family
    // use any network card present
    servaddr.sin_addr.s_addr = htonl(INADDR_ANY);
    servaddr.sin_port        = htons(PORT_NUM);	// daytime server

    // 3. "Bind" that address object to our listening file descriptor
    if (bind(listenfd, (SA *) &servaddr, sizeof(servaddr)) == -1) {
        perror("Unable to bind port");
        exit(2);
    }

    // 4. Tell the system that we are going to use this sockect for
    //    listening and request a queue length
    if (listen(listenfd, LISTENQ) == -1) {
        perror("Unable to listen");
        exit(3);
    }
    

    for ( ; ; ) {
        // 5. Block until someone connects.
        //    We could provide a sockaddr if we wanted to know details of whom
        //    we are talking to.
        //    Last arg is where to put the size of the sockaddr if
        //    we asked for one
		fprintf(stderr, "Ready to connect.\n");
			if ((connfd = accept(listenfd, (SA *) NULL, NULL)) == -1) {
				perror("accept failed");
				exit(4);
		}
		fprintf(stderr, "Connected\n");
        // We had a connection.  Do whatever our task is.
		vector<string> data_tokens;
        read(connfd,buff,255);
		string token;
		string data = string(buff);
		//Insert data into stringstream
		stringstream ss(data);
		while(getline(ss, token, '~')){
			data_tokens.push_back(string(token));
		}
		cout << data_tokens[0]+"\n"<<flush;
		if(data_tokens[0]=="get-users"){
			getUsers(connfd);
		}
		else if(data_tokens[0]=="get-tweets"){
			getTweets(connfd);
		}
		else if(data_tokens[0]=="get-followers"){
			getFollowers(connfd);
		}
		else if(data_tokens[0]=="add-user"){
			addUser(data_tokens[1],connfd);
		}
		else if(data_tokens[0]=="add-tweet"){
			createTweet(data_tokens[1],connfd);
		}
		else if(data_tokens[0]=="add-follower"){
			addFollower(data_tokens[1]);
		}
		else if(data_tokens[0]=="remove-follower"){
			deleteFollower(data_tokens[1]);
		}
		memset(&buff, 0, sizeof(buff));
        // 6. Close the connection with the current client and go back
        //    for another.
        cout << &connfd << flush;
        close(connfd);
    }
}

