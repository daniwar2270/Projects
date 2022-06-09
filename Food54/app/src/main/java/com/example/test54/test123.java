package com.example.test54;

import java.io.IOException;

import okhttp3.OkHttpClient;
import okhttp3.Request;
import okhttp3.Response;

public class test123 {

    Thread thread = new Thread(new Runnable() {

        @Override
        public void run() {
            OkHttpClient client = new OkHttpClient().newBuilder()
                    .build();
            Request request = new Request.Builder()
                    .url("https://maps.googleapis.com/maps/api/distancematrix/json?origins=Washington%2C%20DC&destinations=New%20York%20City%2C%20NY&units=imperial&key=AIzaSyAaletR8n104qtIPhNwde-2M3eIcpTF_Xs")
                    .method("GET", null)
                    .build();
            try {
                Response response = client.newCall(request).execute();
            } catch (
                    IOException e) {
                e.printStackTrace();
            }
            String asdasd = new String();
        }

    });

//thread.start();


}


    //OkHttpClient client = new OkHttpClient().newBuilder()
    //        .build();
    //Request request = new Request.Builder()
    //        .url("https://maps.googleapis.com/maps/api/distancematrix/json?origins=Washington%2C%20DC&destinations=New%20York%20City%2C%20NY&units=imperial&key=AIzaSyAaletR8n104qtIPhNwde-2M3eIcpTF_Xs")
    //        .method("GET", null)
    //        .build();
    //    try {
    //    Response response = client.newCall(request).execute();
    //} catch (
    //IOException e) {
    //    e.printStackTrace();
    //}
    //String asdasd = new String();