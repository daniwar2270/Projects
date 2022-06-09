package com.example.test54;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;


import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.Spinner;
import android.widget.TextView;
import android.widget.Toast;

import com.google.android.gms.maps.model.LatLng;
import com.google.android.gms.tasks.OnFailureListener;
import com.google.android.gms.tasks.OnSuccessListener;
import com.google.firebase.auth.FirebaseAuth;
import com.google.firebase.firestore.DocumentReference;
import com.google.firebase.firestore.FirebaseFirestore;

import java.util.HashMap;
import java.util.Map;

import javax.validation.constraints.Null;

public class MainActivity extends AppCompatActivity {
    TextView welcomeTV;
Button button;
Button button2;
Button button3;

Button logoutBtn;



    public static final String SHARED_PREFS = "shared_prefs";

    // key for storing email.
    public static final String EMAIL_KEY = "email_key";

    // key for storing password.
    public static final String PASSWORD_KEY = "password_key";



    // variable for shared preferences.
    SharedPreferences sharedpreferences;
    String email;
    FirebaseAuth mAuth;
    FirebaseFirestore db = FirebaseFirestore.getInstance();
    @Override
    protected void onCreate(Bundle savedInstanceState) {

        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        sharedpreferences = getSharedPreferences(SHARED_PREFS, Context.MODE_PRIVATE);



        Intent intent =new Intent(MainActivity.this,MapsActivity.class);



        button = findViewById(R.id.Button);
        button2= findViewById(R.id.Button2);
        button3= findViewById(R.id.Button3);
        Spinner spinner = findViewById(R.id.food_selection);



        email = sharedpreferences.getString(EMAIL_KEY, null);

        button.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {

               // intent.putExtra("location","hui");
                startActivity(intent);



            }
        });

        button2.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {

                LatLng loc=getIntent().getParcelableExtra("location");

                if(loc == null){
                    Toast.makeText(MainActivity.this, "Няма избрана локация!", Toast.LENGTH_SHORT).show();}
                else {



                        Toast.makeText(MainActivity.this, loc.toString(), Toast.LENGTH_SHORT).show();
                }
            }
        });


        button3.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {



                LatLng loc=getIntent().getParcelableExtra("location");

                if(loc == null){ Toast.makeText(MainActivity.this, "МОЛЯ ИЗБЕРИ АДРЕС!", Toast.LENGTH_SHORT).show();}
                else {
                    double latt = loc.latitude;
                    double longi = loc.longitude;
                    //if(task.isSuccessful()) {
                    Map<String, Object> order = new HashMap<>();
                    order.put("food", spinner.getSelectedItem().toString());
                    order.put("lat", latt);
                    order.put("lon", longi);
                    order.put("size", 1);
                    order.put("uid", email);


                    db.collection("orders")
                            .add(order)
                            .addOnSuccessListener(new OnSuccessListener<DocumentReference>() {
                                @Override
                                public void onSuccess(DocumentReference documentReference) {

                                }
                            })
                            .addOnFailureListener(new OnFailureListener() {
                                @Override
                                public void onFailure(@NonNull Exception e) {

                                }
                            });


                    Toast.makeText(MainActivity.this, "УСПЕШНА ПОРЪЧКА!", Toast.LENGTH_SHORT).show();


                }
                }
        });


        Button logoutBtn = findViewById(R.id.Button4);
        logoutBtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {


                SharedPreferences.Editor editor = sharedpreferences.edit();


                editor.clear();


                editor.apply();


                Intent i = new Intent(MainActivity.this, LoginActivity.class);
                startActivity(i);
                finish();
            }
        });

        String[] items = new String[]{"Двоен Чийз Бургер", "Веган Бургер", "Food54 Бургер"};
        ArrayAdapter<String> adapter = new ArrayAdapter<>(this, android.R.layout.simple_spinner_dropdown_item, items);
        spinner.setAdapter(adapter);



    }


}