package com.example.matthew.letseatversion1;

import android.app.AlertDialog;
import android.content.Context;
import android.os.AsyncTask;
import android.support.v7.app.ActionBarActivity;
import android.os.Bundle;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.EditText;

import org.apache.http.HttpEntity;
import org.apache.http.HttpRequest;
import org.apache.http.HttpResponse;
import org.apache.http.NameValuePair;
import org.apache.http.client.HttpClient;
import org.apache.http.client.entity.UrlEncodedFormEntity;
import org.apache.http.client.methods.HttpPost;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.message.BasicNameValuePair;
import org.apache.http.util.EntityUtils;

import java.util.ArrayList;
import java.util.List;


public class accountCreationScreen extends ActionBarActivity {

    String newUserID;
    String newUserPassword;
    String newCity;
    String newLastname;
    String newFirstname;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_account_creation_screen);
    }


    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.menu_account_creation_screen, menu);
        return true;
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        // Handle action bar item clicks here. The action bar will
        // automatically handle clicks on the Home/Up button, so long
        // as you specify a parent activity in AndroidManifest.xml.
        int id = item.getItemId();

        //noinspection SimplifiableIfStatement
        if (id == R.id.action_settings) {
            return true;
        }

        return super.onOptionsItemSelected(item);
    }


    public void accountCreationButtonClick(View view) {

        EditText editTextEmail = (EditText) findViewById(R.id.newUsername);
        EditText editTextPassword = (EditText) findViewById(R.id.newPassword);
        EditText editTextCity = (EditText) findViewById(R.id.newCity);
        EditText editTextFirstname = (EditText) findViewById(R.id.newFirstname);
        EditText editTextLastname = (EditText) findViewById(R.id.newLastname);

        newUserID = editTextEmail.getText().toString();
        newUserPassword = editTextPassword.getText().toString();
        newCity = editTextCity.getText().toString();
        newLastname = editTextFirstname.getText().toString();
        newFirstname = editTextLastname.getText().toString();

        new HttpRequest().execute("http://www.csce.uark.edu/~mrs018/Create.php");

    }




    Context context = this;


    class HttpRequest extends AsyncTask<String,String,String>
    {
        String username;
        String password;
        String city;
        String firstname;
        String lastname;

        @Override
        protected void onPostExecute(String result) {
            // TODO Auto-generated method stub
            super.onPostExecute(result);
            new AlertDialog.Builder(context)

                    .setTitle("response from server")
                    .setMessage(result)
                    .setIcon(android.R.drawable.ic_dialog_alert).show();

        }

        @Override
        protected void onPreExecute() {
            // TODO Auto-generated method stub
            username = newUserID;
            password = newUserPassword;
            city = newCity;
            firstname = newFirstname;
            lastname = newLastname;
            super.onPreExecute();
        }

        @Override
        protected String doInBackground(String... params) {
            try
            {
                ArrayList<NameValuePair> nameValuePairs = new ArrayList<NameValuePair>();
                nameValuePairs.add(new BasicNameValuePair("username", username));
                nameValuePairs.add(new BasicNameValuePair("password", password));
                nameValuePairs.add(new BasicNameValuePair("hometown", city));
                nameValuePairs.add(new BasicNameValuePair("firstname", firstname));
                nameValuePairs.add(new BasicNameValuePair("lastname", lastname));
                HttpClient httpclient = new DefaultHttpClient();
                HttpPost method = new HttpPost(params[0]);
                method.setEntity(new UrlEncodedFormEntity(nameValuePairs));

                HttpResponse response = httpclient.execute(method);
                HttpEntity entity = response.getEntity();
                if(entity != null){
                    return EntityUtils.toString(entity);
                }
                else{
                    return "No string.";
                }
            }
            catch(Exception e){
                return "Network problem";
            }

        }
    }


}




