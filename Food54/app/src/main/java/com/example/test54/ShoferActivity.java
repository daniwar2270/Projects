package com.example.test54;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.fragment.app.FragmentActivity;

import android.content.Intent;
import android.graphics.BitmapFactory;
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
import com.google.android.gms.maps.model.BitmapDescriptorFactory;
import com.google.android.gms.maps.model.LatLng;
import com.google.android.gms.maps.model.Marker;
import com.google.android.gms.maps.model.MarkerOptions;
import com.example.test54.databinding.ActivityShoferBinding;
import com.google.android.gms.tasks.OnCompleteListener;
import com.google.android.gms.tasks.OnFailureListener;
import com.google.android.gms.tasks.OnSuccessListener;
import com.google.android.gms.tasks.Task;
import com.google.firebase.crashlytics.buildtools.reloc.org.apache.http.HttpEntity;
import com.google.firebase.firestore.CollectionReference;
import com.google.firebase.firestore.DocumentSnapshot;
import com.google.firebase.firestore.FirebaseFirestore;
import com.google.firebase.firestore.GeoPoint;
import com.google.firebase.firestore.Query;
import com.google.firebase.firestore.QueryDocumentSnapshot;
import com.google.firebase.firestore.QuerySnapshot;



import org.json.simple.JSONArray;
import org.json.simple.parser.JSONParser;
import org.json.simple.JSONObject;
import org.json.simple.parser.ParseException;


import java.io.FileNotFoundException;
import java.io.PrintWriter;
import java.util.Collection;
import java.util.Iterator;
import java.util.LinkedHashMap;
import java.util.ListIterator;
import java.util.Map;

import java.io.FileWriter;
import java.io.IOException;
import java.io.PrintWriter;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Map;
import java.util.Scanner;
import java.util.concurrent.CompletableFuture;
import java.util.regex.Pattern;

import okhttp3.Call;
import okhttp3.Callback;
import okhttp3.OkHttpClient;
import okhttp3.Request;
import okhttp3.Response;


public class ShoferActivity extends FragmentActivity implements OnMapReadyCallback {

    private GoogleMap mMap;
    private ActivityShoferBinding binding;
    Button button;
    Button buttonCompleteOrder;
    TextView textview1;
    LatLng location;
    FirebaseFirestore db = FirebaseFirestore.getInstance();
    int selectedMarkerIndex;
    Marker  currSelectedMarker;
    String shortestPathAnswer = "NO PATH";
    int finalPathCost;
    int[][] arr = new int[10][10];

    ArrayList<orderData> orderList  = new ArrayList<orderData>();

    public ShoferActivity() throws IOException {
    }

    public void storeDist(int distance,int i ,int j){
        arr[i][j]=distance;
        boolean allStored=true;

        for (int i1=0; i1<orderList.size(); i1++) {
            for (int j1 = 0; j1 < orderList.size(); j1++) {

                if(arr[i1][j1]==-1)allStored=false;
            }
        }

        if(allStored){
            System.out.println("WORKIUNG");

            testing123();
        }


    }




    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);

        binding = ActivityShoferBinding.inflate(getLayoutInflater());
        setContentView(binding.getRoot());

        //Intent intent =new Intent(MapsActivity.this,MainActivity.class);
        textview1 = findViewById(R.id.resultTextView);
        button = findViewById(R.id.button1);
        buttonCompleteOrder = findViewById(R.id.button2);
        button.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {

            String textPath = "0::"+shortestPathAnswer+"0";
                int sum=0;
                String[] pathCosts = textPath.split("::");
                for (String item: pathCosts) {
                    sum+=Integer.valueOf(item);
                }
                textview1.setText("НАЙ-ДОБЪР ПЪТ:  "+textPath+"\n"+"ВРЕМЕ: "+finalPathCost+" секунди");


            }
        });

        buttonCompleteOrder.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {

                if(currSelectedMarker==null){Toast.makeText(ShoferActivity.this, "Няма избрана локация!", Toast.LENGTH_SHORT).show();}
                else {



                    CollectionReference itemsRef = db.collection("orders");
                    Query query = itemsRef.whereEqualTo("uid", orderList.get(selectedMarkerIndex).getUid());

                    query.get().addOnCompleteListener(new OnCompleteListener<QuerySnapshot>() {
                        @Override
                        public void onComplete(@NonNull Task<QuerySnapshot> task) {
                            if (task.isSuccessful()) {
                                for (DocumentSnapshot document : task.getResult()) {
                                    itemsRef.document(document.getId()).delete();
                                    Toast.makeText(ShoferActivity.this,
                                            "Успешно изпълнена",
                                            Toast.LENGTH_SHORT).show();
                                    currSelectedMarker.setIcon(BitmapDescriptorFactory.defaultMarker(BitmapDescriptorFactory.HUE_GREEN));
                                    currSelectedMarker = null;
                                }
                            } else {
                                Toast.makeText(ShoferActivity.this,
                                        "Неуспешно изпълнена",
                                        Toast.LENGTH_SHORT).show();

                            }
                        }
                    });

                }
            }
        });

        // Obtain the SupportMapFragment and get notified when the map is ready to be used.
        SupportMapFragment mapFragment = (SupportMapFragment) getSupportFragmentManager()
                .findFragmentById(R.id.map);
        mapFragment.getMapAsync(this);


    }





    Thread thread = new Thread(new Runnable()
    {
        Response response;

        @Override
    public void run() {
        //getting coord
        LatLng startLocation  = new LatLng(42.6448, 23.3389);
        for (int i=0; i<orderList.size(); i++)
        {
            orderData item = orderList.get(i);
            textview1.append(Integer.toString(i)+" : "+item.getFood()+ item.getUid()+"\n");

            OkHttpClient client = new OkHttpClient().newBuilder()
                    .build();
            Request request = new Request.Builder()
                    .url("https://maps.googleapis.com/maps/api/distancematrix/json" +
                            "?origins="+ String.valueOf(startLocation.latitude)+"%2C"+String.valueOf(startLocation.longitude)+
                            "&destinations=42.652811885082606"+"%2C"+"23.350106133643536" +
                            "&units=imperial" +
                            "&key=AIzaSyAaletR8n104qtIPhNwde-2M3eIcpTF_Xs").method("GET", null)

                    .build();
            try {
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
                System.out.println(finalStr);


              } catch (
                      IOException | ParseException e) {
            e.printStackTrace();

            }
        }
        }
  });




    @Override
    public void onMapReady(GoogleMap googleMap) {
        mMap = googleMap;

        // headquarters coordinates
        LatLng food54  = new LatLng(42.6448, 23.3389);

        mMap.moveCamera(CameraUpdateFactory.newLatLngZoom(food54,15f));


        db.collection("orders")
                .get()
                .addOnCompleteListener(new OnCompleteListener<QuerySnapshot>() {
                    @Override
                    public void onComplete(@NonNull Task<QuerySnapshot> task) {
                        if (task.isSuccessful()) {
                            int counter=0;
                            for (QueryDocumentSnapshot document : task.getResult()) {

                                double lat = document.getDouble("lat");
                                double lng = document.getDouble("lon");
                                LatLng latLng = new LatLng(lat, lng);
                                if(counter==0) {
                                    orderList.add(new orderData("START","FOOD SUPPLY",
                                            counter//(document.getLong("size")).intValue()
                                            ,food54.latitude,food54.longitude));
                                    mMap.addMarker(new MarkerOptions().position(food54).title(Integer.toString(counter  )));
                                    counter++;
                                }
                                orderList.add(new orderData(document.getString("food"),document.getString("uid"),
                                        counter//(document.getLong("size")).intValue()
                                        ,document.getDouble("lat"),document.getDouble("lon")));

                                mMap.addMarker(new MarkerOptions().position(latLng).title(Integer.toString(counter  )).icon(BitmapDescriptorFactory.defaultMarker(BitmapDescriptorFactory.HUE_BLUE)).snippet(document.getString("food")+"//"+document.getString("uid")));
                                counter++;
                            }

                        } else {

                        }


                        textview1.setText("");
                        for (int i=0; i<orderList.size(); i++)
                        {
                            orderData item = orderList.get(i);
                            textview1.append(Integer.toString(i)+" : "+item.getFood()+ item.getUid()+"\n");
                        }

                        //thread.start();
                        arr = new int[orderList.size()][orderList.size()];
                        for (int i=0; i<orderList.size(); i++) {
                            for (int j = 0; j < orderList.size(); j++) {
                                arr[i][j]=-1;
                            }
                        }

                        for (int i=0; i<orderList.size(); i++)
                        {
                            for (int j=0; j<orderList.size(); j++)
                            {
                                orderData a = orderList.get(i);
                                orderData b = orderList.get(j);
                                LatLng start = new LatLng(a.lat,a.lon);
                                LatLng end = new LatLng(b.lat,b.lon);
                                getDistanceAB(start,end,i,j);


                            }
                        }

                    }
                });


        mMap.setOnMarkerClickListener(new GoogleMap.OnMarkerClickListener() {
            @Override
            public boolean onMarkerClick(final Marker marker) {


                currSelectedMarker = marker;
                selectedMarkerIndex=Integer.valueOf(marker.getTitle());

                return false;
            }
        });







    }

    public void testing123(){

        int cities = orderList.size();
        Graph g = new Graph();
        //create scanner class object to get input from user
        Scanner sc = new Scanner(System.in);

        // get total number of cities from the user
        System.out.println("Enter total number of cities ");





        // create an array of type boolean to check if a node has been visited or not
        boolean[] visitCity = new boolean[cities];




        // by default, we make the first city visited
        visitCity[0] = true;


        int hamiltonianCycle = Integer.MAX_VALUE;

        // call findHamiltonianCycle() method that returns the minimum weight Hamiltonian Cycle
        hamiltonianCycle = g.findHamiltonianCycle(arr, visitCity, 0, cities, 1, 0, hamiltonianCycle,"","");
         shortestPathAnswer= g.shortestP;
        // print the minimum weighted Hamiltonian Cycle
        finalPathCost =hamiltonianCycle;
        System.out.println(finalPathCost);
        System.out.println(shortestPathAnswer);
        // for each loop
        for (int i=g.poc.size()-orderList.size();i<g.poc.size();i++)
        {
            System.out.println("BEST PATH:"+g.poc.get(i));
        }

    }

    public void getDistanceAB(LatLng a,LatLng b,int i1,int j1){
        Thread thread = new Thread(new Runnable()
        {
            Response response;

            @Override
            public void run() {


                    OkHttpClient client = new OkHttpClient().newBuilder()
                            .build();
                    Request request = new Request.Builder()
                            .url("https://maps.googleapis.com/maps/api/distancematrix/json" +
                                    "?origins="+ String.valueOf(a.latitude)+"%2C"+String.valueOf(a.longitude)+
                                    "&destinations="+String.valueOf(b.latitude)+"%2C"+String.valueOf(b.longitude) +
                                    "&units=imperial" +
                                    "&key=AIzaSyAaletR8n104qtIPhNwde-2M3eIcpTF_Xs").method("GET", null)

                            .build();
                    try {
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
                        System.out.println(finalStr);


                        ShoferActivity.this.storeDist(Integer.parseInt(finalStr),i1,j1);


                    } catch (
                            IOException | ParseException e) {
                        e.printStackTrace();

                    }

            }
        });
        thread.start();




    }






}
