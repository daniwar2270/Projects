package com.example.test54;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;

import android.content.Context;
import android.content.SharedPreferences;
import android.os.Bundle;


import android.content.Intent;
import android.util.Log;
import android.util.Patterns;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import com.google.android.gms.tasks.OnCompleteListener;
import com.google.android.gms.tasks.Task;
import com.google.firebase.auth.FirebaseAuth;
import com.google.firebase.firestore.FirebaseFirestore;
import com.google.firebase.firestore.QueryDocumentSnapshot;
import com.google.firebase.firestore.QuerySnapshot;

public class LoginActivity extends AppCompatActivity {
    private EditText user_name, pass_word;
    FirebaseAuth mAuth;

    // creating constant keys for shared preferences.
    public static final String SHARED_PREFS = "shared_prefs";

    // key for storing email.
    public static final String EMAIL_KEY = "email_key";

    // key for storing password.
    public static final String PASSWORD_KEY = "password_key";

    // variable for shared preferences.
    SharedPreferences sharedpreferences;
    String email, password;
    String user_role_test;
    String user_role;
    FirebaseFirestore db = FirebaseFirestore.getInstance();

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);


        sharedpreferences = getSharedPreferences(SHARED_PREFS, Context.MODE_PRIVATE);


        email = sharedpreferences.getString(EMAIL_KEY, null);
        password = sharedpreferences.getString(PASSWORD_KEY, null);



        user_name=findViewById(R.id.email);
        pass_word=findViewById(R.id.password);
        Button btn_login = findViewById(R.id.btn_login);
        Button btn_sign = findViewById(R.id.btn_signup);

        mAuth=FirebaseAuth.getInstance();
        btn_login.setOnClickListener(v -> {
            String email= user_name.getText().toString().trim();
            String password=pass_word.getText().toString().trim();
            if(email.isEmpty())
            {
                user_name.setError("Празно поле имейл");
                user_name.requestFocus();
                return;
            }
            if(!Patterns.EMAIL_ADDRESS.matcher(email).matches())
            {
                user_name.setError("Моля въведете валиден имейл адрес!");
                user_name.requestFocus();
                return;
            }
            if(password.isEmpty())
            {
                pass_word.setError("Празно поле парола!");
                pass_word.requestFocus();
                return;
            }
            if(password.length()<6)
            {
                pass_word.setError("Дължината на паролата е повече от 6!");
                pass_word.requestFocus();
                return;
            }
            mAuth.signInWithEmailAndPassword(email,password).addOnCompleteListener(task -> {
                if(task.isSuccessful())
                {
                    SharedPreferences.Editor editor = sharedpreferences.edit();


                    String test =mAuth.getCurrentUser().getUid();


                    ///////////////////
                    db.collection("users")
                            .whereEqualTo("uid", test)
                            .get()
                            .addOnCompleteListener((OnCompleteListener<QuerySnapshot>) task1 -> {
                                if (task1.isSuccessful()) {
                                    for (QueryDocumentSnapshot document : task1.getResult()) {


                                        user_role= document.getString("role");





                                    }
                                }


                                else {

                                }


                                editor.putString(EMAIL_KEY,test);
                                editor.apply();



                                if(user_role.equals("driver")){

                                    startActivity(new Intent(LoginActivity.this, ShoferActivity.class));}


                                else {
                                    startActivity(new Intent(LoginActivity.this, MainActivity.class));
                                }
                            });


                }
                else
                {
                    Toast.makeText(LoginActivity.this,
                            "Моля, проверете си входните данни!",
                            Toast.LENGTH_SHORT).show();
                }

            });
        });
        btn_sign.setOnClickListener(v -> startActivity(new Intent(LoginActivity.this,RegisterActivity.class )));
    }

}