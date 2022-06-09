package com.example.test54;

import com.google.android.gms.maps.model.LatLng;
import com.jcabi.aspects.Async;

import org.json.simple.JSONArray;
import org.json.simple.JSONObject;
import org.json.simple.parser.JSONParser;
import org.json.simple.parser.ParseException;

import java.io.IOException;
import java.util.regex.Pattern;

import okhttp3.OkHttpClient;
import okhttp3.Request;
import okhttp3.Response;
import androidx.annotation.NonNull;
import androidx.fragment.app.FragmentActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;
import android.widget.Toast;

import com.example.test54.databinding.ActivityShoferBinding;
import com.google.android.gms.maps.CameraUpdateFactory;
import com.google.android.gms.maps.GoogleMap;
import com.google.android.gms.maps.OnMapReadyCallback;
import com.google.android.gms.maps.SupportMapFragment;
import com.google.android.gms.maps.model.LatLng;
import com.google.android.gms.maps.model.MarkerOptions;
import com.example.test54.databinding.ActivityShoferBinding;
import com.google.android.gms.tasks.OnCompleteListener;
import com.google.android.gms.tasks.Task;
import com.google.firebase.crashlytics.buildtools.reloc.org.apache.http.HttpEntity;
import com.google.firebase.firestore.FirebaseFirestore;
import com.google.firebase.firestore.GeoPoint;
import com.google.firebase.firestore.QueryDocumentSnapshot;
import com.google.firebase.firestore.QuerySnapshot;

public class RouteDuration {


    @Async
    public int getTravelDuraiton(LatLng start,LatLng end){
        //LatLng startLocation  = new LatLng(42.6448, 23.3389);

        OkHttpClient client = new OkHttpClient().newBuilder()
                .build();
        Request request = new Request.Builder()
                .url("https://maps.googleapis.com/maps/api/distancematrix/json" +
                        "?origins="+ String.valueOf(start.latitude)+"%2C"+String.valueOf(start.longitude)+
                        "&destinations="+ String.valueOf(end.latitude)+"%2C"+String.valueOf(end.longitude) +
                        "&units=imperial" +
                        "&key=YOUR_API_KEY")


                .method("GET", null)

                .build();

        try {
            Response response;
            response = client.newCall(request).execute();

            String testing = response.body().string();

            JSONParser parser = new JSONParser();
            JSONObject json = (JSONObject) parser.parse(testing);


            JSONArray jsonObject1 = (JSONArray) json.get("rows");
            JSONObject jsonObject2 = (JSONObject)jsonObject1.get(0);
            JSONArray jsonObject3 = (JSONArray)jsonObject2.get("elements");
            JSONObject elementObj = (JSONObject) jsonObject3.get(0);
            JSONObject durationObj = (JSONObject)elementObj.get("duration");

            String duration = durationObj.toString();


            String[] arrOfStr = duration.split(":", 3);
            String newStr = arrOfStr[2];
            String[] arrOfStr2 = newStr.split(Pattern.quote("}"));
            String finalStr = arrOfStr2[0];
            Integer.parseInt(finalStr);


            return Integer.parseInt(finalStr);




        } catch (
                IOException | ParseException e) {
            e.printStackTrace();
        }
        return 123;
    }

}
